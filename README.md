# Calibr
Calibr is a Project idea to create a free, open-source community for students to actively share resources. Upon completion, Project Calibr will be available on http://calibracademy.com

## Setup
1. Clone Repo and move into folder:
```bash
git clone https://github.com/drtweety/Calibr.git && cd Calibr
```
2. If you're running Calibr for production, run the command:
```
  git checkout v0.1
```
3. Create Database in MySQL and add a user with all privileges to said database.
4. Run SQL script in `db.sql`
5. Assign values to `DB`, `hostname`, `user` and `password` in `app/DB.sql`
6. Enter Mailgun private API key in `app/Mail.php`
7. Install Ruby, and then SASS:
```bash
sudo apt-get install ruby
sudo gem -i sass
```
8. Compile SASS from `sass/styles` to `css/`
```bash
sass --update sass/styles/:css/
```

## Vendor Repos
Calibr uses these libraries and vendor snippets to simplify the development process:
1. [bootstrap](http://getbootstrap.com)
2. [jQuery](http://jquery.com)
3. [TinyMCE](https://www.tinymce.com)
4. [fontawesome.io](http://fontawesome.io)
5. [Mailgun](http://mailgun.org)
