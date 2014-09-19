module.exports=function(s){require("load-grunt-tasks")(s,{scope:"devDependencies"}),require("time-grunt")(s),s.initConfig({pkg:s.file.readJSON("package.json"),banner:"/*\n  Theme Name:       <%= pkg.name%>\n  Theme URI:        <%= pkg.homepage %>\n  Author:           Lacy Morrow\n  Author URI:       http://lacymorrow.com\n  Description:      <%= pkg.description %>\n  Version:          <%= pkg.version%>\n  License:          GNU General Public License v2.0\n  License URI:      http://www.gnu.org/licenses/gpl-2.0.html\n  Text Domain:      dauid\n  Domain Path:      /languages/\n  Tags:             responsive-layout, black, white, one-column, fluid-layout, custom-header, custom-menu, editor-style\n  GitHub Theme URI: <%= pkg.repository.url %>\n  GitHub Branch:    master\n  dauid is based on Underscores http://underscores.me/, (C) 2012-2014 Automattic, Inc.\n*/",autoprefixer:{options:{browsers:["> 1%","last 2 versions","Firefox ESR","Opera 12.1","ie 9"]},dauid:{expand:!0,flatten:!0,src:"<%= concat.dauid.dest %>"}},concat:{options:{banner:"<%= banner %>\n",stripBanners:!0},dauid:{src:["css/style.css","src/css/**/*.css"],dest:"css/style.css"}},csscomb:{dauid:{src:"<%= concat.dauid.dest %>",dest:"<%= concat.dauid.dest %>"}},csslint:{src:["<%= concat.dauid.dest %>"]},cssmin:{dauid:{options:{banner:"<%= banner %>",noAdvanced:!0,compatibility:"ie8",keepSpecialComments:0},files:{"style.css":["<%= concat.dauid.dest %>"],"rtl.css":["css/rtl.css"]}}},imagemin:{dauid:{files:[{expand:!0,cwd:"src/img/",src:["**/*.{png,jpg,gif}"],dest:"img/"}]}},jshint:{dauid:["Gruntfile.js","src/js/**/*.js","js/**/*.js"],options:{globals:{jQuery:!0,console:!0,module:!0,document:!0}}},less:{dauid:{files:{"css/style.css":["src/less/style.less"],"css/rtl.css":["src/less/rtl.less"]}}},uglify:{options:{banner:'/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'},dauid:{src:"src/js/**/*.js",dest:"js/main.js"}},watch:{options:{livereload:!0},dauid:{files:["Gruntfile.js","src/**/*"],tasks:["default"],options:{nospawn:!0}}}}),s.registerTask("js",["uglify"]),s.registerTask("css",["less","concat","csscomb","autoprefixer","cssmin"]),s.registerTask("default",["css","js","imagemin"])};