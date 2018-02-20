Admin
{
	PRMRYKY 'Email'
	Name ,
	College Code,
	Paswword,
	Mobile No,
	DOB,
	Gender,
	Photo,

    College LOgo,
	College Name,
	College City,
	College State,
}

Persons
{
	PRMRYKY 'Email',
	Name ,
	Mobile No,
	DOB,
	Gender,
	College Code,
	Photo,

	TG Flag,
	TG_sem,
	Dept,
	Role
}



Student
{
	CollegeCode
	PRMRYKY 'Email'
	Name ,
	Mobile No,
	DOB,
	Gender,
	College Code,
	Photo,

	Dept,
	SEM =6th SEM
	TG_Email,
	Enrollment
}

notic_college{

    College_code,
    Auther_email,
    Contant_id,
    Time,
    Title,

    Type,
}

contant{
    College_code,
	Contant_id,
	Image,
	Text,
	String
}

notice_tg{
    College_code,
    Auther_email,
    Contant_id,
    Time,
    Title

    Department,
	Sem,
}

notice_dept{
	College_code,
    Auther_email,
    Contant_id,
    Time,
    Title

	Department,
}

college_time_table{
	College_code,
	Dept,
	Sem,
	Section,
	Contant_img,
	Auther_email
}

academic_calender{
	College_code,
	Contant_img,
	Auther_email
}

