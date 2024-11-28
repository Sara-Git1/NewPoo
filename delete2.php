<?php
// Assuming a Connection class is defined in a separate header file
#include "connection.h"

int main() {
    // Replace with your actual database credentials
    const char* servername = "localhost";
    const char* username = "your_username";
    const char* password = "your_password";
    const char* dbName = "your_database_name";

    // Get the ID from the GET request (simulated here)
    int id = 123;  // Replace with actual ID from the request

    // Create a connection to the database
    MYSQL* conn = mysql_init(NULL);
    if (!mysql_real_connect(conn, servername, username, password, dbName, 0)) {
        std::cerr << "Error connecting to database: " << mysql_error(conn) << std::endl;
        return 1;
    }

    // Include the Client class (assuming it's in a separate header file)
    #include "client.h"

    // Delete the client
    if (Client::deleteClient(conn, id)) {
        std::cout << "Client deleted successfully" << std::endl;
    } else {
        std::cerr << "Error deleting client: " << Client::errorMsg << std::endl;
    }

    // Close the connection
    mysql_close(conn);

    return 0;
}
?>