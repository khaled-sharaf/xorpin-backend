const env = require('minimist')(process.argv.slice(2))
const gulp = require('gulp')
const sass = require('gulp-sass')
const concat = require('gulp-concat')
const autoprefixer = require('gulp-autoprefixer')
const gutil       = require('gulp-util')
const plumber     = require('gulp-plumber')
const browserify  = require('gulp-browserify')
const uglify      = require('gulp-uglify')
const gulpif      = require('gulp-if')
const imagemin    = require('gulp-imagemin')


// Call Uglify and Concat JS
// gulp.task('js', function () {
//     return gulp.src('resources/js/main.js')
//         .pipe(plumber())
//         .pipe(concat('main.js'))
//         .pipe(gulpif(env.p, uglify()))
//         .pipe(gulp.dest('build/js'));
// });

// Call Uglify and Concat JS
gulp.task('browserify', function () {
    return gulp.src('resources/js/main.js')
        .pipe(plumber())
        .pipe(browserify({debug: !env.p}))
        .pipe(gulpif(env.p, uglify()))
        .pipe(gulp.dest('public/admin/js'));
});

// Call Watch
gulp.task('watch', function () {
    gulp.watch('resources/js/**/*.*', ['browserify']);
    // gulp.watch('src/img/**/*.{jpg,png,gif}', ['imagemin']);
});

gulp.task('default', ['browserify']);

