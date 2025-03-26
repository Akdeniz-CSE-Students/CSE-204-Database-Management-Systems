from course_manager import CourseManager

def main():
    # Initialize CourseManager with our CSV file
    course_mgr = CourseManager("CourseInfo.csv")

    print("Initial CSE courses:")
    # Get and print all CSE courses
    cse_courses = course_mgr.get_courses("CSE")
    for course in cse_courses:
        print(course)

    print("\nTesting all operations:")
    
    # Test adding a new course
    print("\n1. Adding new course TEST101...")
    course_mgr.add_course("TEST", "101", "Test Course", 10)
    
    # Test removing a course
    print("2. Removing course MAT222...")
    course_mgr.remove_course("MAT", "222")
    
    # Test changing AKTS
    print("3. Changing AKTS of CSE101T to 6...")
    course_mgr.change_akts("CSE", "101T", 6)
    
    # Test changing course code
    print("4. Changing course code CSE204 to CSE208...")
    course_mgr.change_course_code("CSE", "204", "208")
    
    print("\nFinal list of all courses:")
    # Get and print all courses
    all_courses = course_mgr.get_courses()
    for course in all_courses:
        print(course)

if __name__ == "__main__":
    main() 