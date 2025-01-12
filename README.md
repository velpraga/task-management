# task-management

User Table Create

### Columns:

1. **`id`** (INT, Primary Key, Auto Increment)
   * Type: `int(11)`
   * This is the unique identifier for each user. It is set as the primary key, which means it will be unique and automatically indexed. The `AUTO_INCREMENT` attribute automatically generates a unique number for each new record.
2. **`first_name`** (VARCHAR, Nullable)
   * Type: `varchar(50)`
   * This column stores the user's first name, with a maximum length of 50 characters. It is not required, so it can be `NULL`.
3. **`last_name`** (VARCHAR, Nullable)
   * Type: `varchar(50)`
   * This column stores the user's last name, with a maximum length of 50 characters. It is also nullable.
4. **`email`** (VARCHAR, Not Null, Unique)
   * Type: `varchar(100)`
   * This column stores the user's email address, which is unique across the `users` table. It has a maximum length of 100 characters and cannot be `NULL`.
5. **`password`** (VARCHAR, Not Null)
   * Type: `varchar(255)`
   * This column stores the user's password. It is required (`NOT NULL`) and can store passwords up to 255 characters, typically for hashed passwords.
6. **`role`** (ENUM, Default 'User')
   * Type: `enum('Admin','User')`
   * This column stores the user's role. The allowed values are `'Admin'` and `'User'`. The default value is `'User'`.
7. **`status`** (ENUM, Default 'Active')
   * Type: `enum('Active','Inactive')`
   * This column stores the user's status. The allowed values are `'Active'` and `'Inactive'`. The default value is `'Active'`.
8. **`reset_password_token`** (VARCHAR, Nullable)
   * Type: `varchar(255)`
   * This column stores a token used for password reset requests. It is nullable, meaning it can be `NULL` when there is no active password reset request.
9. **`created_at`** (TIMESTAMP, Default current_timestamp)
   * Type: `timestamp`
   * This column stores the timestamp when the user record was created. It is automatically set to the current timestamp when a new record is inserted.
10. **`updated_at`** (TIMESTAMP, Default current_timestamp, ON UPDATE current_timestamp)
    * Type: `timestamp`
    * This column stores the timestamp when the user record was last updated. It is automatically set to the current timestamp when the record is first created and updated automatically on any update to the record.

### Indexes:

* **Primary Key (`id`)** : The `id` column is the primary key, ensuring uniqueness and indexing of the user record.
* **Unique Key (`email`)** : The `email` column has a unique index, ensuring no two users can have the same email address.

### Storage Engine:

* **`ENGINE=InnoDB`** : The table uses the InnoDB storage engine, which supports transactions, foreign keys, and row-level locking.

### Character Set:

* **`DEFAULT CHARSET=utf8mb4`** : The table uses the `utf8mb4` character set, which supports storing multi-byte characters (including emojis).

### Collation:

* **`COLLATE=utf8mb4_general_ci`** : This specifies the collation used for string comparisons. `utf8mb4_general_ci` is a case-insensitive collation.

### Summary:

This table is designed to store user data, including personal information (first name, last name, email), authentication details (password), and other attributes (role, status, reset password token). It ensures that each user has a unique email and supports automatic timestamps for creation and updates. The table is optimized for UTF-8 character sets and uses the InnoDB storage engine for advanced features like transactions



Task Table Create

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    assigned_to INT, -- Foreign key for user ID, if applicable
    status ENUM('Pending', 'In Progress', 'Completed', 'On Hold', 'Cancelled') DEFAULT 'Pending',
    priority ENUM('Low', 'Medium', 'High', 'Critical') DEFAULT 'Medium',
    due_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

### Columns:

1. **`id`** (INT, Primary Key, Auto Increment)
   * Type: `INT`
   * This is the unique identifier for each task. It is set as the primary key, which ensures it is unique and indexed. The `AUTO_INCREMENT` attribute automatically generates a unique value for each new task record.
2. **`title`** (VARCHAR, Not Null)
   * Type: `VARCHAR(255)`
   * This column stores the title of the task, with a maximum length of 255 characters. It is a required field (`NOT NULL`).
3. **`description`** (TEXT, Nullable)
   * Type: `TEXT`
   * This column stores the detailed description of the task. It can hold a large amount of text and is nullable, meaning it is not required to have a value.
4. **`assigned_to`** (INT, Nullable, Foreign Key)
   * Type: `INT`
   * This column stores the user ID of the person to whom the task is assigned. It is a foreign key referencing the `id` column in the `users` table. The `assigned_to` column is nullable, which means the task does not have to be assigned to anyone initially.
   * **Foreign Key** : The `assigned_to` column is linked to the `id` column of the `users` table. If the referenced user in the `users` table is deleted, the `assigned_to` value will be set to `NULL` (`ON DELETE SET NULL`).
5. **`status`** (ENUM, Default 'Pending')
   * Type: `ENUM('Pending', 'In Progress', 'Completed', 'On Hold', 'Cancelled')`
   * This column stores the status of the task. The allowed values are:
     * `'Pending'`
     * `'In Progress'`
     * `'Completed'`
     * `'On Hold'`
     * `'Cancelled'`
   * The default status is `'Pending'`.
6. **`priority`** (ENUM, Default 'Medium')
   * Type: `ENUM('Low', 'Medium', 'High', 'Critical')`
   * This column stores the priority level of the task. The allowed values are:
     * `'Low'`
     * `'Medium'`
     * `'High'`
     * `'Critical'`
   * The default priority is `'Medium'`.
7. **`due_date`** (DATE, Nullable)
   * Type: `DATE`
   * This column stores the due date for the task. It is nullable, meaning the task may not have a specified due date initially.
8. **`created_at`** (TIMESTAMP, Default current_timestamp)
   * Type: `TIMESTAMP`
   * This column stores the timestamp when the task was created. It is automatically set to the current timestamp when a new task record is inserted.
9. **`updated_at`** (TIMESTAMP, Default current_timestamp, ON UPDATE current_timestamp)
   * Type: `TIMESTAMP`
   * This column stores the timestamp when the task was last updated. It is automatically set to the current timestamp when the record is first created and updated automatically on any update to the record.

### Relationships:

* **Foreign Key on `assigned_to`** : This column references the `id` column in the `users` table. If the referenced user is deleted, the `assigned_to` field will be set to `NULL` (`ON DELETE SET NULL`). This ensures that if a user is removed, the task remains but no longer has an assigned user.

### Storage Engine:

* **`ENGINE=InnoDB`** : The table uses the InnoDB storage engine, which supports transactions, foreign keys, and row-level locking, providing high reliability and data integrity.

### Summary:

This `tasks` table is designed to manage tasks in a task management system. It stores details about each task, such as the title, description, status, priority, due date, and timestamps for creation and updates. It also supports the assignment of tasks to users via the `assigned_to` column, which is a foreign key referencing the `users` table. The table ensures proper relationships and data integrity with the use of foreign keys and default values. The InnoDB storage engine provides advanced features for managing the data and maintaining referential integrity.
