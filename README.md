# CRUD Application - Tire, Oil, and Spark Plug Inventory

## Overview
This project is a simple CRUD (Create, Read, Update, Delete) application built using PHP and MySQL. The system allows users to add, view, update, and delete inventory records for tires, oil, and spark plugs.

## Features
- **Add Records:** Users can enter quantities for tires, oil, and spark plugs.
- **View Records:** Data is displayed in a table format.
- **Update Records:** Modify existing records using a Bootstrap modal form.
- **Delete Records:** Remove records from the database.
- **Bootstrap UI:** Provides a clean and responsive interface.

## Technologies Used
- PHP (for backend logic)
- MySQL (for database management)
- Bootstrap 5 (for UI styling)
- JavaScript (for form interactions)

## Installation
1. Clone this repository:
   ```bash
   https://github.com/BertramChabu/CRUD.git
   ```
2. Navigate to the project directory:
   ```bash
   cd CRUD
   ```
3. Import the database:
   - Open `phpMyAdmin` or MySQL command line.
   - Create a database named `student`.
   - Import `database.sql` (if provided) or manually create the `order` table:
   ```sql
   CREATE TABLE `order` (
       id INT AUTO_INCREMENT PRIMARY KEY,
       tire_quantity INT NOT NULL,
       oil_quantity INT NOT NULL,
       spark_quantity INT NOT NULL
   );
   ```
4. Update database credentials in `config.php`:
   ```php
   $connection = mysqli_connect("localhost", "root", "", "student");
   ```
5. Start a local server using XAMPP, WAMP, or MAMP.
6. Open the project in a browser:
   ```
   http://localhost/project-folder/
   ```

## Usage
1. Enter quantities for tires, oil, and spark plugs in the form.
2. Click **Add** to insert the data into the database.
3. View the records in the table.
4. Click **Delete** to remove a record.
5. Click **Update** to modify a record using the modal form.

## Known Issues & Fixes
- **Button requires two clicks to work:** This may be due to form submission issues. Adding `event.preventDefault()` in JavaScript can help.
- **Database connection errors:** Ensure MySQL is running and credentials are correct.

## Future Improvements
- Add user authentication for security.
- Implement AJAX for smoother data updates.
- Improve validation and error handling.

## Author
- **Bertram D. Chabu**
- Email: bertramchabu@gmail.com
- GitHub: [your-github-profile](https://github.com/BertramChabu)

## License
This project is licensed under the GNU License.

