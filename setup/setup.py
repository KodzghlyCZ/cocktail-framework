import mysql.connector
from mysql.connector import Error

def get_database_credentials():
    host = input("Enter database host: ")
    user = input("Enter database user: ")
    password = input("Enter database password: ")
    database = input("Enter database name: ")
    return {'host': host, 'user': user, 'password': password, 'database': database}

def create_connection(credentials):
    try:
        connection = mysql.connector.connect(**credentials)
        if connection.is_connected():
            print(f"Connected to MySQL Server: {credentials['host']}")
            return connection
    except Error as e:
        print(f"Error: {e}")
        return None

def create_sql_file(filename, sql_statements):
    with open(filename, 'a') as file:
        for statement in sql_statements:
            file.write(statement + '\n')

def main():
    credentials = get_database_credentials()
    connection = create_connection(credentials)

    if connection:
        # Database operations go here
        # Example: create a table
        cursor = connection.cursor()
        create_table_query = "CREATE TABLE IF NOT EXISTS example_table (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255))"
        cursor.execute(create_table_query)
        connection.commit()
        cursor.close()
        connection.close()
    else:
        # Save SQL statements to a file
        sql_statements = ["CREATE TABLE IF NOT EXISTS example_table (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255))"]
        create_sql_file("database_changes.sql", sql_statements)

if __name__ == "__main__":
    main()
