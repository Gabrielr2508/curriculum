<?php

namespace App\Providers;

use ReCaptcha\ReCaptcha;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class RecaptchaValidatorServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
			$ip = request()->getClientIp();
			$recaptcha = new ReCaptcha(env('INVISIBLE_RECAPTCHA_SECRETKEY'));
			$resp = $recaptcha->verify($value, $ip);

			return $resp->isSuccess();
		});
	}
}
