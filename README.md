# DRONE E-Commerce

# About the project
You can read about the project, it's structure and objective in the `wiki` section.

# How to run the project
1. Make sure you have c++ and `Makefile` related tools and libraries installed in your system
2. At a terminal, create a folder and run a `git clone` inside of it with the project's Github URL
3. At the project's root, run `make install`
4. Create a database named `droneinventory` or create one with any name
6. `cd` into the `src` directory
7. Copy the `.env.example` file into a `.env` file
8. Edit the `.env` file and change the following files to the expected values:
	- Database name
 	- Database user and password
 	- Google maps key  
9. `cd` back to the root folder and run `make run`

# Access as admin
To have an admin user we first need to create an standard user
1. With the application running, access the homepage (If local typically at localhost:8000)
2. At the top-right corner click the `register` button
3. Create a user by filling the creation form
4. Access `PhpMyAdmin` and look up the new user and change its role attribute to `admin`
5. Or if using pure SQL and the CLI, access the table and perform an `alter` on the selected user by changing its role.
6. Go back to the application and login with the password.
7. Access `<BASE_URL>/admin`
