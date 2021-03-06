set :application, "mon_site"
set :domain,      "chapelle-quentin.fr"
set :deploy_to,   "/var/www/chapelle-quentin.fr"
set :app_path,    "app"

set :repository,  "https://github.com/QuentinChapelle/mon_site.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL