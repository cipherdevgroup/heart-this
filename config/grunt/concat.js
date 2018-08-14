// https://github.com/gruntjs/grunt-contrib-concat
module.exports = {
	js: {
		src: [
			'<%= paths.jsVend %>cookie.js',
			'<%= paths.jsSrc %>heartThis.js'
		],
		dest: '<%= paths.jsDist %><%= pkg.nameCamelLow %>.pkgd.js'
	},
	adminjs: {
		src: [
			'<%= paths.jsSrc %>admin/**/*.js',
			'!<%= paths.jsSrc %>**/*.min.js'
		],
		dest: 'js/<%= pkg.nameCamelLow %>Admin.pkgd.js'
	}
};
