<?php
class Connection {
private:
    std::string servername;
    std::string username;
    std::string password;
    MYSQL* conn;

public:
    Connection(const std::string& servername, const std::string& username, const std::string& password) {
        this->servername = servername;
        this->username = username;
        this->password = password;

        // Initialize the MySQL library
        mysql_init(&conn);

        // Connect to the database
        if (!mysql_real_connect(&conn, servername.c_str(), username.c_str(), password.c_str(), nullptr, 0)) {
            std::cerr << "Connection failed: " << mysql_error(&conn) << std::endl;
            exit(1);
        }

        std::cout << "Connected successfully" << std::endl;
    }

    ~Connection() {
        mysql_close(&conn);
    }

    void createDatabase(const std::string& dbName) {
        std::string query = "CREATE DATABASE " + dbName;

        if (mysql_query(&conn, query.c_str())) {
            std::cerr << "Error creating database: " << mysql_error(&conn) << std::endl;
        } else {
            std::cout << "Database created successfully" << std::endl;
        }
    }

    void selectDatabase(const std::string& dbName) {
        if (mysql_select_db(&conn, dbName.c_str())) {
            std::cerr << "Error selecting database: " << mysql_error(&conn) << std::endl;
        } else {
            std::cout << "Database selected successfully" << std::endl;
        }
    }

    void createTable(const std::string& query) {
        if (mysql_query(&conn, query.c_str())) {
            std::cerr << "Error creating table: " << mysql_error(&conn) << std::endl;
        } else {
            std::cout << "Table created successfully" << std::endl;
        }
    }
};
?>