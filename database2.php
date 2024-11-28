<?php 
    // Replace with your actual database credentials
    const char* servername = "localhost";
    const char* username = "your_username";
    const char* password = "your_password";

    MYSQL* conn = mysql_init(NULL);

    // Connect to the database
    if (!mysql_real_connect(conn, servername, username, password, NULL, 0)) {
        std::cerr << "Error connecting to database: " << mysql_error(conn) << std::endl;
        return 1;
    }

    // Create a database
    const char* createDbQuery = "CREATE DATABASE chap4Db";
    if (mysql_query(conn, createDbQuery)) {
        std::cerr << "Error creating database: " << mysql_error(conn) << std::endl;
    } else {
        std::cout << "Database created successfully" << std::endl;
    }

    // Select the database
    if (mysql_select_db(conn, "chap4Db")) {
        std::cerr << "Error selecting database: " << mysql_error(conn) << std::endl;
    } else {
        std::cout << "Database selected successfully" << std::endl;
    }

    // Create a table
    const char* createTableQuery = "CREATE TABLE Clients (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, email VARCHAR(50) UNIQUE, password VARCHAR(80), reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
    if (mysql_query(conn, createTableQuery)) {
        std::cerr << "Error creating table: " << mysql_error(conn) << std::endl;
    } else {
        std::cout << "Table Clients created successfully" << std::endl;
    }

    // Query the table (optional)
    const char* selectQuery = "SELECT id, firstname, lastname FROM Clients";
    MYSQL_RES* result = mysql_query(conn, selectQuery);
    if (result) {
        MYSQL_ROW row;
        while ((row = mysql_fetch_row(result))) {
            std::cout << "id: " << row[0] << " - Name: " << row[1] << " " << row[2] << std::endl;
        }
        mysql_free_result(result);
    } else {
        std::cerr << "Error querying table: " << mysql_error(conn) << std::endl;
    }

    // Close the connection
    mysql_close(conn);

    return 0;
}

?>