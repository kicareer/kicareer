<style>
    .resume-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px;
        padding: 20px 30px;
        position: relative;
    }

    .section {
        margin-bottom: 20px;
    }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .skill-item {
        background: #f8f9fa;
        padding: 8px;
        border-radius: 5px;
        border-left: 3px solid '.$primary_color.';
    }

    .experience-item, .education-item {
        margin-bottom: 15px;
        padding-left: 15px;
        border-left: 2px solid '.$secondary_color.';
        position: relative;
    }

    .company-details {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .watermark {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-45deg);
        opacity: 0.1;
        width: 300px;
        z-index: 0;
        pointer-events: none;
    }

    .resume-header {
        background: linear-gradient(135deg, '.$primary_color.' 0%, '.$secondary_color.' 100%);
        color: white;
        padding: 30px;
        position: relative;
        overflow: hidden;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 1;
    }

    .profile-image {
        width: 130px;
        height: 130px;
        border-radius: 10px;
        border: 4px solid rgba(255,255,255,0.3);
        object-fit: cover;
    }

    .header-text h1 {
        font-size: 32px;
        margin: 0 0 8px 0;
    }

    .header-text p {
        font-size: 14px;
        margin: 3px 0;
    }

    h3 {
        margin: 5px 0;
        font-size: 16px;
    }

    p {
        margin: 5px 0;
    }

    .section-title {
        margin-bottom: 12px;
        font-size: 18px;
    }

    .resume-container {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
    }
</style> 