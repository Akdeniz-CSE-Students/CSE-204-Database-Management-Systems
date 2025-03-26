# Course Management System

A modern GUI application for managing university courses. Built with Python and Tkinter, this application provides an intuitive interface for handling course-related operations.

## Features

- 📚 List all courses with detailed information
- ➕ Add new courses with validation
- ❌ Remove existing courses
- 🔄 Update course information (AKTS and Course Code)
- 🔍 Filter courses by department
- 📊 Table view with sortable columns
- 🔄 Auto-refresh functionality
- 🎨 Modern UI with Arc theme
- ⚡ Real-time updates
- ❌ Error handling and input validation

## Requirements

```bash
Python 3.x
tkinter (usually comes with Python)
ttkthemes
pillow (PIL)
```

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/course-management-system.git
cd course-management-system
```

2. Install required packages:
```bash
pip install ttkthemes pillow
```

## Usage

1. Run the application:
```bash
python course_gui.py
```

2. The application has four main tabs:
   - **List Courses**: View and filter all courses
   - **Add Course**: Add a new course with details
   - **Remove Course**: Remove an existing course
   - **Change Course**: Modify AKTS or course code

## File Structure

```
python_course_manager/
├── course_gui.py        # Main GUI application
├── course_manager.py    # Course management logic
├── CourseInfo.csv       # Course data storage
├── logo.png            # Application logo
└── README.md           # This file
```

## Data Format

The course information is stored in CSV format with the following structure:
- Course Department
- Course Code
- Course Title
- Course AKTS

Example:
```csv
CSE,101,Introduction to Computer Science,6
MAT,101,Calculus I,6
```

## Features in Detail

### List Courses
- View all courses in a table format
- Filter courses by department
- Auto-refresh when data changes
- Sortable columns

### Add Course
- Input validation for all fields
- AKTS must be a positive number
- Prevents duplicate entries
- Clear form after successful addition

### Remove Course
- Simple removal by department and course code
- Confirmation before deletion
- Error handling for non-existent courses

### Change Course
- Modify AKTS values
- Change course codes
- Input validation
- Automatic updates in the course list

## Error Handling

The application includes comprehensive error handling for:
- Missing input fields
- Invalid AKTS values
- Non-existent courses
- Duplicate courses
- File operations

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Author

[Your Name]
- Website: [efekurucay.com](https://efekurucay.com)

## Acknowledgments

- Built with Python and Tkinter
- Uses ttkthemes for modern UI
- Inspired by university course management systems 