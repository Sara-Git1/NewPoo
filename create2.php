<?php
// Include connection class header (assuming it's in a separate file)
#include "connection.h"

class Client {
public:
    int id;
    std::string firstname;
    std::string lastname;
    std::string email;
    std::string password;  // Store hashed password
    std::string reg_date;
    static std::string errorMsg;
    static std::string successMsg;

    // Constructor (consider using a separate function for password hashing)
    Client(const std::string& firstname, const std::string& lastname,
           const std::string& email, const std::string& password) {
        this->firstname = firstname;
        this->lastname = lastname;
        this->email = email;

        // Hash the password using a secure library function
        this->password = hashPassword(password);  // Replace with actual hashing logic
    }

    // Function to insert a client into the database (using prepared statements for security)
    static bool insertClient(const std::string& tableName, std::shared_ptr<sql::Connection> conn, const Client& client) {
        try {
            // Prepare the SQL statement with placeholders for values
            std::string sql = "INSERT INTO " + tableName + " (firstname, lastname, email, password, reg_date) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)";
            std::unique_ptr<sql::PreparedStatement> stmt(conn->prepareStatement(sql));

            // Bind values to placeholders
            stmt->setString(1, client.firstname);
            stmt->setString(2, client.lastname);
            stmt->setString(3, client.email);
            stmt->setString(4, client.password);

            // Execute the prepared statement
            stmt->execute();

            successMsg = "Client inserted successfully";
            return true;
        } catch (const sql::SQLException& e) {
            errorMsg = "Error inserting client: " + e.what();
            return false;
        }
    }

private:
    // Replace with your actual password hashing function using a secure library
    std::string hashPassword(const std::string& password) {
        // Implement secure password hashing using a library like bcrypt or Argon2
        return "hashed_password";  // Placeholder for actual hashed value
    }
};

// Static member variables (outside the class definition)
std::string Client::errorMsg = "";
std::string Client::successMsg = "";



    ?>