from flask import Flask, render_template, request
from ai.ai_resume import generate_summary

app = Flask(__name__)

@app.route("/")
def index():
    return render_template("index.html")

@app.route("/generate", methods=["POST"])
def generate():
    name = request.form.get("name")
    email = request.form.get("email")
    phone = request.form.get("phone")
    role = request.form.get("role")
    skills = request.form.get("skills")
    experience = request.form.get("experience")

    # AI-generated professional summary
    summary = generate_summary(name, skills, experience, role)

    return render_template("resume.html",
                           name=name,
                           email=email,
                           phone=phone,
                           role=role,
                           skills=skills,
                           experience=experience,
                           summary=summary)

if __name__ == "__main__":
    app.run(debug=True)
