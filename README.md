# Calibr
Calibr is a Project idea to create a free, open-source community for students to actively share resources. Upon completeion, Project Calibr will be available on http://calibracademy.com

## Setup
1. Clone Repo and move into folder:
```bash
git clone https://github.com/drtweety/Calibr.git && cd Calibr
```
2. Create Database in MySQL and add a user with all privileges to said database.
3. Run SQL script in `db.sql`
4. Assign values to `DB`, `hostname`, `user` and `password` in `app/DB.sql`
5. Install Ruby, and then SASS:
```bash
sudo apt-get install ruby
sudo gem -i sass
```
6. Compile SASS from `sass/styles` to `css/`
```bash
sass --update sass/styles/:css/
```
