import csv
import os

class CourseManager:
    def __init__(self, file_path):
        """
        Initialize the CourseManager with a CSV file path
        Args:
            file_path (str): Path to the CSV file containing course information
        """
        self.file_path = file_path
        # Check if file exists, if not create it
        if not os.path.exists(file_path):
            with open(file_path, 'w', newline='') as file:
                pass

    def get_courses(self, department=None):
        """
        Get a list of all courses or courses from a specific department
        Args:
            department (str, optional): Department code to filter courses. Defaults to None.
        Returns:
            list: List of course codes (department + code)
        """
        courses = []
        with open(self.file_path, 'r') as file:
            reader = csv.reader(file)
            for row in reader:
                if len(row) >= 2:  # Ensure row has department and code
                    if department is None or row[0] == department:
                        courses.append(row[0] + row[1])
        return courses

    def add_course(self, department, code, title, akts):
        """
        Add a new course to the CSV file
        Args:
            department (str): Department code
            code (str): Course code
            title (str): Course title
            akts (int): AKTS value
        """
        # First check if course already exists
        with open(self.file_path, 'r') as file:
            reader = csv.reader(file)
            for row in reader:
                if len(row) >= 2 and row[0] == department and row[1] == code:
                    raise ValueError(f"Course {department}{code} already exists!")

        # Add new course
        with open(self.file_path, 'a', newline='') as file:
            writer = csv.writer(file)
            writer.writerow([department, code, title, akts])

    def remove_course(self, department, code):
        """
        Remove a course from the CSV file
        Args:
            department (str): Department code
            code (str): Course code
        """
        # Read all courses
        courses = []
        found = False
        with open(self.file_path, 'r') as file:
            reader = csv.reader(file)
            for row in reader:
                if len(row) >= 2 and row[0] == department and row[1] == code:
                    found = True
                    continue
                courses.append(row)

        if not found:
            raise ValueError(f"Course {department}{code} not found!")

        # Write back all courses except the removed one
        with open(self.file_path, 'w', newline='') as file:
            writer = csv.writer(file)
            writer.writerows(courses)

    def change_akts(self, department, code, new_akts):
        """
        Change the AKTS value of a course
        Args:
            department (str): Department code
            code (str): Course code
            new_akts (int): New AKTS value
        """
        courses = []
        found = False
        with open(self.file_path, 'r') as file:
            reader = csv.reader(file)
            for row in reader:
                if len(row) >= 4 and row[0] == department and row[1] == code:
                    row[3] = str(new_akts)
                    found = True
                courses.append(row)

        if not found:
            raise ValueError(f"Course {department}{code} not found!")

        with open(self.file_path, 'w', newline='') as file:
            writer = csv.writer(file)
            writer.writerows(courses)

    def change_course_code(self, department, current_code, new_code):
        """
        Change the course code of a course
        Args:
            department (str): Department code
            current_code (str): Current course code
            new_code (str): New course code
        """
        courses = []
        found = False
        with open(self.file_path, 'r') as file:
            reader = csv.reader(file)
            for row in reader:
                if len(row) >= 2 and row[0] == department and row[1] == current_code:
                    row[1] = new_code
                    found = True
                courses.append(row)

        if not found:
            raise ValueError(f"Course {department}{current_code} not found!")

        with open(self.file_path, 'w', newline='') as file:
            writer = csv.writer(file)
            writer.writerows(courses) 