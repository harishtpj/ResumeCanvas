# 📝 ResumeCanvas

Transform a resume into a beautiful, interactive portfolio website using AI.

ResumeCanvas is a Laravel + Vue application that allows users to upload their resumes and automatically generate a modern single-page portfolio website. The generated portfolio can be previewed, edited, downloaded, and managed directly from a personalized dashboard.

# 🌟 Features

### Authentication
- User registration and login
- Secure session-based authentication
- Personalized dashboard

### AI Portfolio Generation
- Upload resumes in PDF format
- AI powered automatic generation of complete portfolio websites
- Generation of interactive, SPA-style portfolios with customized design (Uses TailwindCSS + Alpine.js)

### Portfolio Management
- Create portfolios from resumes
- Preview generated websites in-browser
- Responsive viewport simulation
- View generated HTML source
- Ability to share the generated Portfolio

### User Experience
- Beautiful glassmorphic UI
- Responsive design
- Real-time validation feedback
- Toast notifications
- Mobile-friendly navigation

# ⚙️ Tech Stack Used

This project uses the ***PLIV*** stack:
- **Backend**: Laravel + PostgreSQL
- **Frontend**: Vue.js + TailwindCSS
- Integration via **Inertia.js**
- **AI**: Google Gemini (via Laravel AI SDK)

# 🚀 Installation

This project requires:
- PHP (>= 8.4) and Composer
- Node and npm

1. Start by cloning the repo.

```bash
$ git clone https://github.com/harishtpj/ResumeCanvas.git
$ cd ResumeCanvas
```

2. Install the dependencies and setup DB

```bash
$ composer run setup
```
*NOTE* that the local development server uses SQLite as database. If you wanted to change that, you can 
configure it at `.env` file.

Also make sure that you set the `GEMINI_API_KEY` in the `.env` file accordingly.

3. Start the server by running
```bash
$ composer run dev
```

# 🌐 Online Demo

This project has been deployed on Render and is publicly available for usage at:

https://resumecanvas-9sjc.onrender.com/

You can use the following demo credentials to login and test the application:
- Email: `demo@eg.co`
- Password: `p@ssw0rd`

> [!NOTE]  
> Due to limitations of Render (for free account), the filesystem is ephemeral. The 'Regenerate Portfolio'
> functionality requires stored resume files in the filesystem. Hence, that feature may fail if invoked
> after a long period of time. All other functionality works as normal.

# 📝 License

#### Copyright © 2026 [M.V.Harish Kumar](https://github.com/harishtpj). <br>
#### This project is [MIT](https://github.com/harishtpj/ResumeCanvas/blob/master/LICENSE) licensed.
