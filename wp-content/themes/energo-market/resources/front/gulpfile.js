'use strict';

// --------------------------------------------------------------------------
// Plugins
// --------------------------------------------------------------------------

var gulp         = require('gulp'),
	browserSync  = require('browser-sync'),
	watch 		 = require('gulp-watch'),
	runSequence  = require('run-sequence'),

	concat		 = require('gulp-concat'),
	plumber 	 = require('gulp-plumber'),
	include      = require("gulp-include"),

	critical     = require('critical'),

	sourcemaps   = require('gulp-sourcemaps'),

	pug          = require('gulp-pug'),
	frontMatter  = require('gulp-front-matter'),
	cached       = require('gulp-cached'),
	changed      = require('gulp-changed'),

	sass 		 = require('gulp-sass'),
	uncss        = require('gulp-uncss'),
	autoprefixer = require('gulp-autoprefixer'),
	minify_css   = require('gulp-minify-css'),
	cleanCSS     = require('gulp-clean-css'),

	pxtorem      = require('gulp-pxtorem'),


	uglify 		 = require('gulp-uglify'),

	streamify    = require('gulp-streamify'),


	spritesmith  = require('gulp.spritesmith'),
	cheerio 	 = require('gulp-cheerio'),
	svgmin       = require('gulp-svgmin'),
	svgSprite    = require("gulp-svg-sprite"),
	replace      = require('gulp-replace'),

	clean        = require('del'),

	zip      	 = require('gulp-zip'),

	notify       = require("gulp-notify"),

	yaml         = require('require-yaml'),
	consolidate  = require('gulp-consolidate'),
	cache        = require('gulp-cache'),


	path         = require('path'),
	babel 		 = require("gulp-babel"),

	gulpif       = require('gulp-if'),
 	rename       = require('gulp-rename'),
 	browserify   = require('browserify'),
 	babelify     = require('babelify'),
 	source       = require('vinyl-source-stream'),

 	imagemin     = require('gulp-imagemin'),

 	inject       = require('gulp-inject-string');





// --------------------------------------------------------------------------
// Settings
// --------------------------------------------------------------------------


var src = {
	pagelist: 'src/yaml/index.yaml',
	html: 'src/pug/**/[^_]*.pug',
	fonts: 'src/fonts/*',
	scss: 'src/scss/**/*.scss',
	js: 'src/js/**/*.js',
	images: 'src/images/**/*',
	video: 'src/video/**/*',

	spriteImages: 'src/sprites/_images/',
	spriteSvg: 'src/sprites/_svg/*.svg',

	json: "src/json/**/*",
};

var dist = {
	pagelist: 'dist/',
	html: 'dist/',
	fonts: 'dist/fonts/',
	css: 'dist/css',
	js: 'dist/js',
	images: 'dist/images/',
	video: 'dist/video/',

	spriteImages: 'dist/sprites/',
	spriteSvg: 'dist/sprites/',

	json: "dist/json/",
};


// --------------------------------------------------------------------------
// Zip
// --------------------------------------------------------------------------


gulp.task('zip', function () {

	function correctNumber(i) {
	    if (i < 10) {
	        i = "0" + i;
	    }
	    return i;
	}

	var zipDir = path.basename(__dirname);
	var zipDate = new Date();
	var zipDatetime = zipDate.getFullYear() + '-' + (zipDate.getMonth() + 1) + '-' + zipDate.getDate() + 'T' + correctNumber(zipDate.getHours()) + ':' + correctNumber(zipDate.getMinutes());
	var zipName = zipDir + '_' + zipDatetime + '.zip';


    gulp.src(['./**', '!./node_modules/', '!./node_modules/**'])
        .pipe(zip(zipDir + '.zip'))
        .pipe(gulp.dest('./'))
});

// --------------------------------------------------------------------------
// Sprites
// --------------------------------------------------------------------------


gulp.task('spriteImages', function () {
	var spriteData = gulp.src(src.spriteImages + '*.png')
	.pipe(plumber({
		errorHandler: notify.onError("Error: <%= error.message %>")
	}))
	.pipe(spritesmith({

		algorithm: 'binary-tree',
		padding: 10,

		cssName: '_sprites.scss',
		cssFormat: 'scss',

	    imgName: 'sprite.png',
	    imgPath: '../sprites/sprite.png',

	    retinaSrcFilter: src.spriteImages + '/*@2x.png',
        retinaImgName: 'sprite@2x.png',
        retinaImgPath: '../sprites/sprite@2x.png',

	    cssTemplate: 'src/sprites/_templates/sprite.template.mustache'

	}));

	spriteData.img
	// .pipe(streamify(
	// 	imagemin([
	// 		imagemin.gifsicle({interlaced: true}),
	// 		imagemin.jpegtran({progressive: true}),
	// 		imagemin.optipng({optimizationLevel: 7}),
	// 		imagemin.svgo({
	// 			plugins: [
	// 				{removeViewBox: true},
	// 				{cleanupIDs: false}
	// 			]
	// 		})
	// 	])
	// ))
	.pipe(gulp.dest('dist/sprites/'));
	spriteData.css.pipe(gulp.dest('src/sprites/'));

	return spriteData;
});



gulp.task('spriteSvg', function () {
    return gulp
        .src(src.spriteSvg)
        .pipe(cheerio({
			run: function ($) {

				// $('[fill]:not([fill="currentColor"])').removeAttr('fill');
				$('[stroke]').removeAttr('stroke');
				$('[fill]').removeAttr('fill');
				// $('[style]').removeAttr('style');
			},
			parserOptions: { xmlMode: true }
		}))
		.pipe(replace('&gt;', '>'))
        .pipe(svgSprite({
        	mode: {
				symbol: {
					dest: "",
					prefix : '.',
            		dimensions : '.',
					sprite: "sprite.svg",
					render: {
						scss: {
							dest:'../../src/sprites/_spritesSvg.scss',
							template: "src/sprites/_templates/scss.templateSvg.handlebars"
						}
					}
				}
			}

        }))
        .pipe(gulp.dest('dist/sprites/'));
});


// --------------------------------------------------------------------------
// Critical
// --------------------------------------------------------------------------



gulp.task('critical', function () {

	critical.generate({
	    inline: false,
	    base: 'dist/',
	    src: 'critical.html',
	    dest: 'css/critical.min.css',
	    minify: true,
	   	width: 1920,
    	height: 4000,
	    include: ['.irs, .irs-bar, .irs-slider, .is-load, .app, .btn, .mfp, .page-thank, .is-sticky, .hero'],

	}, function (err, criticalCss) {

		gulp.src('dist/*.html')
			.pipe(inject.after('<!-- Critical CSS -->', '\n<style>\n' + criticalCss + '\n</style>'))
    		.pipe(gulp.dest('dist'))

	});


});

// --------------------------------------------------------------------------
// Html or Pug
// --------------------------------------------------------------------------

gulp.task('html', function() {

	return gulp.src(src.html)

		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))
		.pipe(frontMatter({ property: 'data' }))
		.pipe(pug({
			pretty: true
		}))
		.pipe(cached('pug'))
		.pipe(gulp.dest(dist.html))
		.pipe(browserSync.reload({ stream: true }))

});



// --------------------------------------------------------------------------
// Fonts
// --------------------------------------------------------------------------

gulp.task('fonts', function() {
    gulp.src(src.fonts)
        .pipe(gulp.dest(dist.fonts))
        .pipe(browserSync.reload({ stream: true }))
});


// --------------------------------------------------------------------------
// Images
// --------------------------------------------------------------------------


gulp.task('images', function() {

	return gulp.src(src.images)
		// .pipe(imagemin([
		// 	imagemin.gifsicle({interlaced: true}),
		// 	imagemin.jpegtran({progressive: true}),
		// 	imagemin.optipng({optimizationLevel: 7}),
		// 	imagemin.svgo({
		// 		plugins: [
		// 			{removeViewBox: true},
		// 			{cleanupIDs: false}
		// 		]
		// 	})
		// ]))
		.pipe(gulp.dest(dist.images))
		.pipe(browserSync.reload({ stream: true }))

});


// --------------------------------------------------------------------------
// video
// --------------------------------------------------------------------------


gulp.task('video', function() {

	return gulp.src(src.video)
		// .pipe(imagemin([
		// 	imagemin.gifsicle({interlaced: true}),
		// 	imagemin.jpegtran({progressive: true}),
		// 	imagemin.optipng({optimizationLevel: 7}),
		// 	imagemin.svgo({
		// 		plugins: [
		// 			{removeViewBox: true},
		// 			{cleanupIDs: false}
		// 		]
		// 	})
		// ]))
		.pipe(gulp.dest(dist.video))
		.pipe(browserSync.reload({ stream: true }))

});


// --------------------------------------------------------------------------
// Json
// --------------------------------------------------------------------------

gulp.task('json', function() {
  return gulp
    .src(src.json)
    .pipe(gulp.dest(dist.json))
    .pipe(browserSync.reload({ stream: true }));
});

// --------------------------------------------------------------------------
// Scss
// --------------------------------------------------------------------------

gulp.task('scss', function() {

	return gulp.src(src.scss)

		.pipe(plumber({
			errorHandler: notify.onError("Error: <%= error.message %>")
		}))
		.pipe(sass())
		.pipe(autoprefixer({
		    browsers: ['last 2 versions', '> 1%', 'ie 9'],
		    cascade: false
		}))
		.pipe(concat('app.min.css'))
		.pipe(pxtorem({
			rootValue: 10,
			unitPrecision: 5,
		    propList: ['top', 'left', 'right', 'bottom', 'font', 'font-size', 'line-height', 'letter-spacing', 'margin', 'margin-top', 'padding', 'height', 'min-height', 'max-height', 'width', 'max-width', 'flex'],
		    selectorBlackList: ['html'],
		    replace: true,
		    mediaQuery: false,
		    minPixelValue: 0
		}))
		// .pipe(minify_css())
		// .pipe(cleanCSS({compatibility: 'ie8'}))
		.pipe(gulp.dest(dist.css))
		.pipe(browserSync.reload({ stream: true }))

});


// --------------------------------------------------------------------------
// Js
// --------------------------------------------------------------------------



gulp.task('js:plugins', function() {
	return gulp.src([
		path.resolve('node_modules', 'svg4everybody/dist/svg4everybody.js'),
		// path.resolve('node_modules', 'axios/dist/axios.min.js'),

		path.resolve('node_modules', 'jquery/dist/jquery.js'),


		// path.resolve('node_modules', 'inputmask/dist/inputmask.js'),
		path.resolve('node_modules', 'jquery-mask-plugin/dist/jquery.mask.js'),

		path.resolve('node_modules', 'jquery-validation/dist/jquery.validate.min.js'),
		path.resolve('node_modules', '@fancyapps/fancybox/dist/jquery.fancybox.js'),
		// path.resolve('node_modules', 'selectric/public/jquery.selectric.js'),
		path.resolve('node_modules', 'swiper/js/swiper.js'),
		path.resolve('node_modules', 'jquery.animate-number/jquery.animateNumber.min.js'),

		path.resolve('node_modules', 'scrollreveal/dist/scrollreveal.js'),



	])
    .pipe(plumber({
		errorHandler: notify.onError("Error: <%= error.message %>")
	}))
    .pipe(concat('plugins.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(dist.js))
	.pipe(browserSync.reload({ stream: true }))
});

gulp.task('js:copy', function() {
	return gulp.src('src/js/plugins/*')
	  // .pipe(uglify())
	  .pipe(gulp.dest('dist/js/plugins'))
	  .pipe(browserSync.reload({ stream: true }))
});

gulp.task('js:app', function() {
	browserify({
	    entries: 'src/js/app.js',
	    debug: true
	})
    .transform(babelify.configure({
		sourceMapRelative: dist.js
    }))
	.bundle()
	.pipe(plumber({
		errorHandler: notify.onError("Error: <%= error.message %>")
	}))
    .pipe(source('app.min.js'))
    // .pipe(streamify(uglify()))
    .pipe(gulp.dest(dist.js))
    .pipe(browserSync.reload({ stream: true }))
});

gulp.task('js', [
	'js:plugins',
	'js:app',
	'js:copy'
]);


// --------------------------------------------------------------------------
// PageList
// --------------------------------------------------------------------------

gulp.task('pages', function() {
	delete require.cache[require.resolve(__dirname + '/src/yaml/index.yaml')]
	var pages = require(__dirname + '/src/yaml/index.yaml');
	return gulp.src(__dirname + '/src/yaml/index.html')
		.pipe(consolidate('lodash', {
			pages: pages
		}))
		.pipe(gulp.dest(dist.pagelist))
		.pipe(browserSync.reload({ stream: true }));

});

// --------------------------------------------------------------------------
// Clean
// --------------------------------------------------------------------------

gulp.task('clean', function() {
	return clean.sync('dist/');
});

// --------------------------------------------------------------------------
// Watch
// --------------------------------------------------------------------------


gulp.task('watch', function() {

	gulp.watch(src.spriteImages + '*.png', ['spriteImages']);
	gulp.watch(src.spriteSvg, ['spriteSvg']);
	gulp.watch(src.pagelist, ['pages']);
	gulp.watch(src.html, ['html']);
	gulp.watch(['src/pug/**/_*.pug', 'src/pug//**/[^_]*.pug'], ['html']);
	gulp.watch(src.fonts, ['fonts']);
	gulp.watch(src.images, ['images']);
	gulp.watch(src.video, ['video']);
	gulp.watch(src.scss, ['scss']);
	gulp.watch(src.js, ['js']);
	gulp.watch(src.json, ["json"]);

	browserSync.init({
		server: 'dist/',
		port: 8080,
		open: true,
    	notify: false
	});

});


// Gulp

gulp.task('default', function() {

	runSequence('clean', 'spriteImages', 'spriteSvg', 'js', 'scss', 'html', 'critical', 'fonts', 'json', 'images', 'video', 'pages', 'watch')

});



