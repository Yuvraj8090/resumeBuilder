from fpdf import FPDF
import os


class ResumePDF(FPDF):
    def header(self):
        self.set_font("DejaVu", "B", 18)
        self.cell(0, 10, self.title, ln=True)
        self.ln(4)

    def section_title(self, title):
        self.ln(6)
        self.set_font("DejaVu", "B", 13)
        self.cell(0, 8, title, ln=True)
        self.set_draw_color(200, 200, 200)
        self.line(10, self.get_y(), 200, self.get_y())
        self.ln(4)

    def section_body(self, text):
        self.set_font("DejaVu", "", 11)
        self.multi_cell(0, 7, text)


def generate_pdf(data, output_dir, filename):
    file_path = os.path.join(output_dir, filename)

    pdf = ResumePDF()
    pdf.set_auto_page_break(auto=True, margin=15)

    # Register Unicode font
    pdf.add_font("DejaVu", "", "fonts/DejaVuSans.ttf", uni=True)
    pdf.add_font("DejaVu", "B", "fonts/DejaVuSans.ttf", uni=True)

    pdf.title = data.get("name", "Resume")
    pdf.add_page()

    # Contact Info
    pdf.set_font("DejaVu", "", 11)
    contact = f"{data.get('email', '')} | {data.get('phone', '')} | {data.get('location', '')}"
    pdf.cell(0, 8, contact, ln=True)

    # Sections
    pdf.section_title("Professional Summary")
    pdf.section_body(data.get("summary", ""))

    pdf.section_title("Skills")
    pdf.section_body(data.get("skills", ""))

    pdf.section_title("Work Experience")
    pdf.section_body(data.get("experience", ""))

    pdf.section_title("Education")
    pdf.section_body(data.get("education", ""))

    pdf.output(file_path)
    return file_path
