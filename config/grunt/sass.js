// https://github.com/sindresorhus/grunt-sass
module.exports = {
	options: {
		sourceMap: true,
		lineNumbers: false,
		outputStyle: 'expanded'
	},
	plugin: {
		files: {
			'<%= paths.tmp %>heart-this.css': '<%= paths.cssSrc %>heart-this.scss'
		}
	}
};
