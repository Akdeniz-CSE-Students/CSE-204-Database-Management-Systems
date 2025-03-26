import tkinter as tk
from tkinter import ttk
from tkinter import messagebox
from ttkthemes import ThemedTk
from PIL import Image, ImageTk
import webbrowser
from course_manager import CourseManager

class CourseManagerGUI:
    def __init__(self, root):
        self.root = root
        self.root.title("Course Manager")
        self.root.geometry("800x600")  # Set window size
        
        # Set theme
        self.root.set_theme("arc")  # Modern blue theme
        
        # Configure style
        self.style = ttk.Style()
        self.style.configure("Accent.TButton", padding=10)
        
        # Create header frame
        self.setup_header()
        
        # Create main notebook (tab control)
        self.notebook = ttk.Notebook(root)
        self.notebook.pack(pady=10, expand=True, fill="both")
        
        # Create tabs
        self.list_tab = ttk.Frame(self.notebook)
        self.add_tab = ttk.Frame(self.notebook)
        self.remove_tab = ttk.Frame(self.notebook)
        self.change_tab = ttk.Frame(self.notebook)
        
        self.notebook.add(self.list_tab, text="List Courses")
        self.notebook.add(self.add_tab, text="Add Course")
        self.notebook.add(self.remove_tab, text="Remove Course")
        self.notebook.add(self.change_tab, text="Change Course")
        
        # Initialize course manager
        self.course_manager = CourseManager("CourseInfo.csv")
        
        # Setup each tab
        self.setup_list_tab()
        self.setup_add_tab()
        self.setup_remove_tab()
        self.setup_change_tab()
        
        # Setup footer
        self.setup_footer()
        
        # Bind tab change event for auto-refresh
        self.notebook.bind("<<NotebookTabChanged>>", self.on_tab_change)

    def setup_header(self):
        header_frame = ttk.Frame(self.root)
        header_frame.pack(fill="x", padx=10, pady=5)
        
        # Load and display logo
        try:
            logo_img = Image.open("logo.png")
            logo_img = logo_img.resize((50, 50), Image.Resampling.LANCZOS)
            self.logo_photo = ImageTk.PhotoImage(logo_img)
            logo_label = ttk.Label(header_frame, image=self.logo_photo)
            logo_label.pack(side="left", padx=5)
        except:
            print("Logo image not found")
        
        title_label = ttk.Label(header_frame, text="Course Management System", 
                              font=("Helvetica", 16, "bold"))
        title_label.pack(side="left", padx=10)

    def setup_footer(self):
        footer_frame = ttk.Frame(self.root)
        footer_frame.pack(fill="x", padx=10, pady=5)
        
        website_link = ttk.Label(footer_frame, text="Visit: efekurucay.com", 
                               cursor="hand2", foreground="blue")
        website_link.pack(side="right", padx=10)
        website_link.bind("<Button-1>", lambda e: webbrowser.open("https://efekurucay.com"))

    def setup_list_tab(self):
        # Department filter frame
        filter_frame = ttk.LabelFrame(self.list_tab, text="Filter", padding="10")
        filter_frame.pack(fill="x", padx=10, pady=5)
        
        ttk.Label(filter_frame, text="Department:").pack(side="left")
        self.dept_filter = ttk.Entry(filter_frame)
        self.dept_filter.pack(side="left", padx=5)
        
        refresh_btn = ttk.Button(filter_frame, text="Show Courses", 
                               command=self.show_courses, style="Accent.TButton")
        refresh_btn.pack(side="left", padx=5)
        
        # Create Treeview for courses
        columns = ("Department", "Code", "Title", "AKTS")
        self.course_tree = ttk.Treeview(self.list_tab, columns=columns, show="headings")
        
        # Configure columns
        for col in columns:
            self.course_tree.heading(col, text=col)
            self.course_tree.column(col, width=100)
        
        # Add scrollbar
        scrollbar = ttk.Scrollbar(self.list_tab, orient="vertical", 
                                command=self.course_tree.yview)
        self.course_tree.configure(yscrollcommand=scrollbar.set)
        
        # Pack everything
        self.course_tree.pack(fill="both", expand=True, padx=10, pady=5)
        scrollbar.pack(side="right", fill="y")
        
        # Initial load
        self.refresh_course_list()

    def setup_add_tab(self):
        frame = ttk.LabelFrame(self.add_tab, text="Add New Course", padding="10")
        frame.pack(padx=10, pady=5, fill="both")
        
        # Create and pack labels and entries
        labels = ["Department:", "Code:", "Title:", "AKTS:"]
        self.add_entries = {}
        
        for i, label in enumerate(labels):
            ttk.Label(frame, text=label).grid(row=i, column=0, pady=5, padx=5, sticky="e")
            entry = ttk.Entry(frame)
            entry.grid(row=i, column=1, pady=5, padx=5, sticky="ew")
            self.add_entries[label] = entry
        
        add_btn = ttk.Button(frame, text="Add Course", command=self.add_course, 
                           style="Accent.TButton")
        add_btn.grid(row=len(labels), column=0, columnspan=2, pady=10)
        
        # Configure grid weights
        frame.columnconfigure(1, weight=1)

    def setup_remove_tab(self):
        frame = ttk.LabelFrame(self.remove_tab, text="Remove Course", padding="10")
        frame.pack(padx=10, pady=5, fill="both")
        
        labels = ["Department:", "Code:"]
        self.remove_entries = {}
        
        for i, label in enumerate(labels):
            ttk.Label(frame, text=label).grid(row=i, column=0, pady=5, padx=5, sticky="e")
            entry = ttk.Entry(frame)
            entry.grid(row=i, column=1, pady=5, padx=5, sticky="ew")
            self.remove_entries[label] = entry
        
        remove_btn = ttk.Button(frame, text="Remove Course", 
                              command=self.remove_course, style="Accent.TButton")
        remove_btn.grid(row=len(labels), column=0, columnspan=2, pady=10)
        
        frame.columnconfigure(1, weight=1)

    def setup_change_tab(self):
        # AKTS change frame
        akts_frame = ttk.LabelFrame(self.change_tab, text="Change AKTS", padding="10")
        akts_frame.pack(padx=10, pady=5, fill="x")
        
        self.akts_entries = {}
        labels = ["Department:", "Code:", "New AKTS:"]
        
        for i, label in enumerate(labels):
            ttk.Label(akts_frame, text=label).grid(row=i, column=0, pady=5, padx=5, sticky="e")
            entry = ttk.Entry(akts_frame)
            entry.grid(row=i, column=1, pady=5, padx=5, sticky="ew")
            self.akts_entries[label] = entry
        
        akts_btn = ttk.Button(akts_frame, text="Change AKTS", 
                            command=self.change_akts, style="Accent.TButton")
        akts_btn.grid(row=len(labels), column=0, columnspan=2, pady=10)
        
        # Code change frame
        code_frame = ttk.LabelFrame(self.change_tab, text="Change Course Code", padding="10")
        code_frame.pack(padx=10, pady=5, fill="x")
        
        self.code_entries = {}
        labels = ["Department:", "Current Code:", "New Code:"]
        
        for i, label in enumerate(labels):
            ttk.Label(code_frame, text=label).grid(row=i, column=0, pady=5, padx=5, sticky="e")
            entry = ttk.Entry(code_frame)
            entry.grid(row=i, column=1, pady=5, padx=5, sticky="ew")
            self.code_entries[label] = entry
        
        code_btn = ttk.Button(code_frame, text="Change Code", 
                            command=self.change_code, style="Accent.TButton")
        code_btn.grid(row=len(labels), column=0, columnspan=2, pady=10)
        
        akts_frame.columnconfigure(1, weight=1)
        code_frame.columnconfigure(1, weight=1)

    def refresh_course_list(self):
        # Clear existing items
        for item in self.course_tree.get_children():
            self.course_tree.delete(item)
        
        # Get all courses
        with open(self.course_manager.file_path, 'r') as file:
            import csv
            reader = csv.reader(file)
            for row in reader:
                if len(row) >= 4:
                    self.course_tree.insert("", "end", values=row)

    def show_courses(self):
        department = self.dept_filter.get().strip()
        
        # Clear existing items
        for item in self.course_tree.get_children():
            self.course_tree.delete(item)
        
        # Get filtered courses
        with open(self.course_manager.file_path, 'r') as file:
            import csv
            reader = csv.reader(file)
            for row in reader:
                if len(row) >= 4:
                    if not department or row[0] == department:
                        self.course_tree.insert("", "end", values=row)

    def on_tab_change(self, event):
        if self.notebook.select() == str(self.list_tab):
            self.refresh_course_list()

    def add_course(self):
        try:
            department = self.add_entries["Department:"].get().strip()
            code = self.add_entries["Code:"].get().strip()
            title = self.add_entries["Title:"].get().strip()
            akts = self.add_entries["AKTS:"].get().strip()
            
            # Validation
            if not all([department, code, title, akts]):
                raise ValueError("All fields are required!")
            
            akts = int(akts)
            if akts <= 0:
                raise ValueError("AKTS must be a positive number!")
            
            self.course_manager.add_course(department, code, title, akts)
            messagebox.showinfo("Success", f"Course {department}{code} added successfully!")
            
            # Clear entries
            for entry in self.add_entries.values():
                entry.delete(0, tk.END)
            
            # Refresh course list
            self.refresh_course_list()
                
        except ValueError as e:
            messagebox.showerror("Error", str(e))
        except Exception as e:
            messagebox.showerror("Error", f"An error occurred: {str(e)}")

    def remove_course(self):
        try:
            department = self.remove_entries["Department:"].get().strip()
            code = self.remove_entries["Code:"].get().strip()
            
            if not all([department, code]):
                raise ValueError("Both Department and Code are required!")
            
            self.course_manager.remove_course(department, code)
            messagebox.showinfo("Success", f"Course {department}{code} removed successfully!")
            
            # Clear entries
            for entry in self.remove_entries.values():
                entry.delete(0, tk.END)
            
            # Refresh course list
            self.refresh_course_list()
                
        except ValueError as e:
            messagebox.showerror("Error", str(e))
        except Exception as e:
            messagebox.showerror("Error", f"An error occurred: {str(e)}")

    def change_akts(self):
        try:
            department = self.akts_entries["Department:"].get().strip()
            code = self.akts_entries["Code:"].get().strip()
            new_akts = self.akts_entries["New AKTS:"].get().strip()
            
            if not all([department, code, new_akts]):
                raise ValueError("All fields are required!")
            
            new_akts = int(new_akts)
            if new_akts <= 0:
                raise ValueError("AKTS must be a positive number!")
            
            self.course_manager.change_akts(department, code, new_akts)
            messagebox.showinfo("Success", f"AKTS changed successfully for {department}{code}!")
            
            # Clear entries
            for entry in self.akts_entries.values():
                entry.delete(0, tk.END)
            
            # Refresh course list
            self.refresh_course_list()
                
        except ValueError as e:
            messagebox.showerror("Error", str(e))
        except Exception as e:
            messagebox.showerror("Error", f"An error occurred: {str(e)}")

    def change_code(self):
        try:
            department = self.code_entries["Department:"].get().strip()
            current_code = self.code_entries["Current Code:"].get().strip()
            new_code = self.code_entries["New Code:"].get().strip()
            
            if not all([department, current_code, new_code]):
                raise ValueError("All fields are required!")
            
            self.course_manager.change_course_code(department, current_code, new_code)
            messagebox.showinfo("Success", f"Course code changed successfully!")
            
            # Clear entries
            for entry in self.code_entries.values():
                entry.delete(0, tk.END)
            
            # Refresh course list
            self.refresh_course_list()
                
        except ValueError as e:
            messagebox.showerror("Error", str(e))
        except Exception as e:
            messagebox.showerror("Error", f"An error occurred: {str(e)}")

def main():
    root = ThemedTk(theme="arc")
    app = CourseManagerGUI(root)
    root.mainloop()

if __name__ == "__main__":
    main() 