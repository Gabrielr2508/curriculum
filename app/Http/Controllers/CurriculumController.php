<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curriculum;
use App\Profile;
use App\Office;
use DB;
use MongoDB\BSON\ObjectId;
use View;
use Session;

class CurriculumController extends Controller
{
	public function index(Request $in)
	{
		$archived = $not_archived = [];
		if ( !$in->not_archived ) {
			$archived = Profile::where('archived', true)->orderBy('star', 'desc')->get();

		}
		if ( !$in->archived ) {
			$not_archived = Profile::where('archived', '!=', true)->orderBy('star', 'desc')->get();
		}

		foreach ($archived as $i => $profile) {
			$profile->_id = encrypt($profile->_id);
			$profile->tag = $this->listTag($profile->_id)['tag'];
		}
		foreach ($not_archived as $i => $profile) {
			$profile->_id = encrypt($profile->_id);
			$profile->tag = $this->listTag($profile->_id)['tag'];
		}

		if ($in->archived) {
			return view('card-section', ['profiles' => $archived]);
		}
		elseif ($in->not_archived) {
			return view('card-section', ['profiles' => $not_archived]);
		}
		else {
			return view('list-curriculas', ['archived' => $archived, 'not_archived' => $not_archived]);	
		}
	}

	public function show($id)
	{
		//mostra o currículo
		$curriculum = Curriculum::where('profile_id', decrypt($id))->orderBy('created_at', 'cres')->firstOrFail();
		if (!$curriculum) {
			return [
				'status' => 0,
				'message' => 'Arquivo não encontrado.',
			];
		}
		$bucket = DB::getMongoDB()->selectGridFSBucket([ 'bucketName' => 'attachment' ]);
		$stream = $bucket->openDownloadStream(new ObjectId($curriculum->attachment_id));
		if ( !isset($stream) ) {
			return [
				'status' => 0,
				'message' => 'Arquivo não encontrado.',
			];
		}
		$metadata = $bucket->getFileDocumentForStream($stream);
		$mimeType = isset($metadata['mimeType']) ?
			$metadata['mimeType'] : $metadata['metadata']['mimeType'];

		return response(stream_get_contents($stream))->header('Content-Type', $mimeType);
	}

	public function store (Request $request) {
		$validatedData = $request->validate([
			'name' => 'required|min:10',
			'areas' => 'required',
			'filename' => 'required',
			'email' => 'required|email',
			'phone' => 'required|size:11',
			'linkedin' => 'nullable|url',
			'github' => 'nullable|url',
			'is_internship' => 'required',
			'file' => 'required|file|mimes:pdf'
		]);

		$profile = Profile::where('email', strtolower($request->email))->first();

		if (!$profile) {
			$profile = new Profile;
			$profile->email = $request->email;
		}

		$profile->name = $request->name;
		$profile->phone = $request->phone;
		$profile->star = '0';
		$profile->is_internship = $request->is_internship;
		$profile->areas = explode(',', $request->areas);
		$profile->tags = [];
		$profile->status = 'E';

		if ($request->linkedin) {
			$profile->linkedin = $request->linkedin;
		}

		if ($request->github) {
			$profile->github = $request->github;
		}

		$profile->save();

		$curriculum = new Curriculum;
		$curriculum->attachment_id = $this->processAttachment($request->file('file'));
		$curriculum->profile_id = $profile->_id;
		$curriculum->save();

		Session::flash('curriculumSended', 'Prontinho! Recebemos seu currículo. Entraremos em contrato em breve. Obrigado! :)');

		return redirect('/');
	}

	public function updateStar(Request $in, $id)
	{
		//atualizar estrelas
		$profile = Profile::find(decrypt($id));
		$profile->star = $in->star;
		$profile->save();
	}

	public function listTag($id)
	{
		//pegar tags
		$tag = [];
		$tag = array_merge(Profile::find(decrypt($id))->tag ?: [], Profile::find(decrypt($id))->office ?: []);
		$tag = Office::find((array) $tag)->pluck('name');
		return [
			'tag' => $tag,
		];
	}

	public function insertTag(Request $in, $id)
	{
		//inserir tag
		$profile = Profile::find(decrypt($id));
		$tag = Office::firstOrCreate(['name' => $in->tag])->_id;
		$profile->tag = $profile->push('tag', $tag);
	}

	public function deleteTag(Request $in, $id)
	{
		//deletar tag
		$profile = Profile::find(decrypt($id));

		$tag = Office::where('name', $in->tag)->first()->id;

		if(empty($profile->pull('tag', $tag))){
			$profile->office = $profile->pull('office', $tag);
		}
	}

	public function archive($id)
	{
		//arquivar profile
		$profile = Profile::find(decrypt($id));
		$profile->archived = true;
		$profile->save();
	}

	public function restore($id)
	{
		//desarquivar profile
		$profile = Profile::find(decrypt($id));
		$profile->archived = false;
		$profile->save();
	}

	private function processAttachment($attachment)
	{
		if ($attachment->isValid()) {
			$bucket = DB::getMongoDB()->selectGridFSBucket(['bucketName' => 'attachment']);
			$file = fopen($attachment->getRealPath(), 'rb');
			$id = $bucket->uploadFromStream($attachment->getClientOriginalName(), $file, [
				'metadata' => ['mimeType' => $attachment->getClientMimeType()],
			]);

			return $id;
		} else {
			return false;
		}
	}
}