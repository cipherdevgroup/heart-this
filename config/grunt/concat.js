// https://github.com/gruntjs/grunt-contrib-concat
module.exports = {
	js: {
		src: [
			'<%= paths.jsSrc %>vendor/cookie.js',
			'<%= paths.jsSrc %><%= pkg.nameCamelLow %>.js'
		],
		dest: 'js/<%= pkg.nameCamelLow %>.pkgd.js'
	},
	adminjs: {
		src: [
			'<%= paths.jsSrc %>admin/**/*.js',
			'!<%= paths.jsSrc %>**/*.min.js'
		],
		dest: 'js/<%= pkg.nameCamelLow %>Admin.pkgd.js'
	}
};
