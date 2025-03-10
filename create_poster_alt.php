// Default values
$title = $job['job_title'] ?? 'Job Title';
$company_name = $job['company_name'] ?? 'Company Name';
$location = "Location: " . ($job['location'] ?? 'Location not specified');

// Convert salary from INR to USD and format it
$salary_min = number_format($job['salary_min'] * 0.012, 2); // Using the same conversion rate
$salary_max = number_format($job['salary_max'] * 0.012, 2);
$salary = "Salary: $" . $salary_min . ' - $' . $salary_max;

$experience = "Experience: " . $job['exper_min'] . '-' . $job['exper_max'] . ' years';
$skills = "Skills: " . ($job['skills'] ?? ''); 