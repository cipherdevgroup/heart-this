// https://github.com/kswedberg/grunt-version
module.exports = {
	options: {
		pkg: {
			version: '<%= package.version %>'
		}
	},
	project: {
		src: [
			'package.json',
			'bower.json'
		]
	},
	phpConstant: {
		options: {
			prefix: 'HEART_THIS_VERSION\'\,\\s+\''
		},
		src: [
			'heart-this.php'
		]
	},
	style: {
		options: {
			prefix: '\\s+\\*\\s+Version:\\s+'
		},
		src: [
			'heart-this.php',
			'<%= paths.cssSrc %>heart-this.scss'
		]
	}
};
