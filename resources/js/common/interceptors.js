
const unauthenticated = function unauthenticatedInterceptor(error) {
	if (error.response && error.response.status === 401) {
		window.location.reload(true);
	}

	return Promise.reject(error);
};

export default unauthenticated;