import java.util.ArrayList;

public class CourseTest {
   public static void main(String[] args) throws Exception {
      CourseInfo c = new CourseInfo("CourseInfo.csv");
      c.addCourse("TEST", "101", "Test course", 10);
      ArrayList<String> courses = c.getCourses("CSE");
      for(String course: courses)
         System.out.println(course);
      c.removeCourse("MAT", "222");
      c.changeAKTS("CSE", "101T", 6);
      c.changeCourseCode("CSE", "204", "208");
   }
}