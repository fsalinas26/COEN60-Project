year = ""
major = ""
advisor = ""

function get_url_params(url) {
    yearIndex = url.indexOf("year=")
    if (yearIndex > -1) {
        year = url.substring(yearIndex + 5, yearIndex + 9)
        document.getElementById(year).classList.add("highlighted")
    }
    else {
        document.getElementById("all_years").classList.add("highlighted")
    }

    
    majorIndex = url.indexOf("major=")
    if (majorIndex > -1) {
        major = url.substring(majorIndex + 6, majorIndex + 10)
        document.getElementById(major).classList.add("highlighted")
    }
    else {
        document.getElementById("all_majors").classList.add("highlighted")
    }
    
    advisorIndex = url.indexOf("advisor=")
    if (advisorIndex > -1) {
        advisor = url.substring(advisorIndex + 8)
        document.getElementById(advisor).classList.add("highlighted")
    }
    else {
        document.getElementById("all_advisors").classList.add("highlighted")
    }
}

function load_data(type, value) {
    url = "index.php?";
    andSymbol = false;
    
    if (type == "year") {
        if (value != "" && value != year) {
            url += "year=" + value;
            andSymbol = true;
        }
    }
    else {
        if (year != "") {
            url += "year=" + year
            andSymbol = true;
        }
    }
    
    if (type == "major") {
        if (value != "" && value != major) {
            if (andSymbol)
                url += "&";
            url += "major=" + value;
            andSymbol = true;
        }
    }
    else {
        if (major != "") {
            if (andSymbol)
                url += "&";
            url += "major=" + major
            andSymbol = true;
        }
    }
    
    
    if (type == "advisor") {
        if (value != "" && value != advisor) {
            if (andSymbol)
                url += "&";
            url += "advisor=" + value;
        }
    }
    else {
        if (advisor != "") {
            if (andSymbol)
                url += "&";
            url += "advisor=" + advisor
        }
    }

    location.href = url;
}

function filter_by_year(year) {
    if (year == "") {
        year_selector = "";
    }
    else {
        year_selector = year;
    }
    load_data()
}

function filter_by_major(major) {
    if (major == "") {
        major_selector = ""
    }
    else {
        major_selector = major;
    }
    load_data()
}

function filter_by_advisor(advisor) {
    if (advisor == "") {
        advisor_selector = ""
    }
    else {
        advisor_selector = advisor;
    }
    load_data()
}


