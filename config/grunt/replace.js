// https://github.com/outaTiME/grunt-replace
module.exports = {
	style: {
		options: {
			patterns: [
				{
					// Add line break between banner and minified
					match: /\*\/(?=\S)/g,
					replacement: '*/\n'
				}
			]
		},
		files: [
			{
				expand: true,
				src: [
					'<%= paths.tmp %>*.min.css'
				]
			}
		]
	},
	// Useful when forking this project into a new project
	packagename: {
		options: {
			patterns: [
				{
					match: /HeartThis/g,
					replacement: '<%= pkg.nameSpaced %>'
				},
				{
					match: /heart this/g,
					replacement: '<%= pkg.nameSpacedLow %>'
				},
				{
					match: /heart-this/g,
					replacement: '<%= pkg.nameDashed %>'
				},
				{
					match: /heart_this/g,
					replacement: '<%= pkg.nameUscore %>'
				},
				{
					match: /HEART_THIS/g,
					replacement: '<%= pkg.nameUscoreUp %>'
				},
				{
					match: /Heart_This/g,
					replacement: '<%= pkg.nameUscoreCam %>'
				},
				{
					match: /HeartThis/g,
					replacement: '<%= pkg.nameCamel %>'
				},
				{
					match: /heartThis/g,
					replacement: '<%= pkg.nameCamelLow %>'
				}
			]
		},
		files: [
			{
				expand: true,
				src: [
					'**',
					'.*',
					'!<%= paths.bower %>**/*',
					'!**/*.{png,ico,jpg,gif}',
					'!node_modules/**',
					'!bower_components/**',
					'!.sass-cache/**',
					'!dist/**',
					'!logs/**',
					'!tmp/**',
					'!*.sublime*',
					'!.idea/**',
					'!.DS_Store'
				]
			}
		]
	}
};
