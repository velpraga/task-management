# task-management

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


Explanation of Columns:

    id:
        A unique identifier for each task (primary key).
    title:
        A brief name or title for the task (required).
    description:
        A longer explanation or details about the task (optional).
    assigned_to:
        Refers to a users table to link a task to a specific user. It uses a foreign key constraint, and tasks are not deleted if the user is removed (uses SET NULL).
    status:
        Tracks the current state of the task (default is Pending).
    priority:
        Indicates the urgency or importance of the task (default is Medium).
    due_date:
        Specifies when the task should be completed.
    created_at:
        Automatically records when the task is created.
    updated_at:
        Automatically updates whenever the task is modified.