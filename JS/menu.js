// admin1
let admin1 = document.getElementById("btn-admin1");
let show_admin1 = document.getElementById("admin1");
    admin1.addEventListener("click", btn_admin1);

    function btn_admin1(){
         //active
         admin1.classList.add("active");
         admin2.classList.remove("active");
         admin3.classList.remove("active");
         pl.classList.remove("active");
         production.classList.remove("active");
         TQA.classList.remove("active");
         sale.classList.remove("active");
         //active
        show_admin1.style.display = "flex";
        show_admin1.style.opacity = 0;

        setTimeout(() => {
            show_admin1.style.opacity = 1;
        }, 0); 

        // hidden
        show_admin2.style.display = "none";
        show_admin3.style.display = "none";
        show_pl.style.display = "none";
        show_production.style.display = "none";
        show_TQA.style.display = "none";
        show_sale.style.display = "none";
        show_auto.style.display = "none";

    }

//admin2
let admin2 = document.getElementById("btn-admin2");
let show_admin2 = document.getElementById("admin2");
    admin2.addEventListener("click", btn_admin2);

    function btn_admin2(){
        //active
        admin2.classList.add("active");
        admin1.classList.remove("active");
        admin3.classList.remove("active");
        pl.classList.remove("active");
        production.classList.remove("active");
        TQA.classList.remove("active");
        sale.classList.remove("active");
        //active

        admin1.classList.remove("active");
        show_admin2.style.display = "flex";
        show_admin2.style.opacity = 0;

        setTimeout(() => {
            show_admin2.style.opacity = 1;
        }, 0); 

        // hidden
        show_admin1.style.display = "none";
        show_admin3.style.display = "none";
        show_pl.style.display = "none";
        show_production.style.display = "none";
        show_TQA.style.display = "none";
        show_sale.style.display = "none";
        show_auto.style.display = "none";



    }

//admin3
let admin3 = document.getElementById("btn-admin3");
let show_admin3 = document.getElementById("admin3");
    admin3.addEventListener("click", btn_admin3);

    function btn_admin3(){
        //active
        admin3.classList.add("active");
        admin2.classList.remove("active");
        admin1.classList.remove("active");
        pl.classList.remove("active");
        production.classList.remove("active");
        TQA.classList.remove("active");
        sale.classList.remove("active");
        //active
        show_admin3.style.display = "flex";
        show_admin3.style.opacity = 0;
        setTimeout(() => {
            show_admin3.style.opacity = 1;
        }, 0); 
        // hidden
        show_admin1.style.display = "none";
        show_admin2.style.display = "none";
        show_pl.style.display = "none";
        show_production.style.display = "none";
        show_TQA.style.display = "none";
        show_sale.style.display = "none";
        show_auto.style.display = "none";


    }


//P&L
let pl = document.getElementById("btn-pl");
let show_pl = document.getElementById("p&l");
    pl.addEventListener("click", btn_pl);

    function btn_pl(){
         //active
         pl.classList.add("active");
         admin3.classList.remove("active");
         admin2.classList.remove("active");
         admin1.classList.remove("active");
         production.classList.remove("active");
         TQA.classList.remove("active");
         sale.classList.remove("active");
         //active
        show_pl.style.display = "flex";
        show_pl.style.opacity = 0;
        setTimeout(() => {
            show_pl.style.opacity = 1;
        }, 0); 

        // hidden
        show_admin1.style.display = "none";
        show_admin2.style.display = "none";
        show_admin3.style.display = "none";
        show_production.style.display = "none";
        show_TQA.style.display = "none";
        show_sale.style.display = "none";
        show_auto.style.display = "none";




    }


//Production
let production = document.getElementById("btn-production");
let show_production = document.getElementById("production");
    production.addEventListener("click", btn_production);

    function btn_production(){
         //active
         production.classList.add("active");
         pl.classList.remove("active");
         admin3.classList.remove("active");
         admin2.classList.remove("active");
         admin1.classList.remove("active");
         TQA.classList.remove("active");
         sale.classList.remove("active");
         //active
        show_production.style.display = "flex";
        show_production.style.opacity = 0;
        setTimeout(() => {
            show_production.style.opacity = 1;
        }, 0); 

        // hidden
        show_admin1.style.display = "none";
        show_admin2.style.display = "none";
        show_admin3.style.display = "none";
        show_pl.style.display = "none";
        show_TQA.style.display = "none";
        show_sale.style.display = "none";
        show_auto.style.display = "none";



    }

//TQA
let TQA = document.getElementById("btn-TQA");
let show_TQA = document.getElementById("TQA");
    TQA.addEventListener("click", btn_TQA);

    function btn_TQA(){
        //active
        TQA.classList.add("active");
        production.classList.remove("active");
        pl.classList.remove("active");
        admin3.classList.remove("active");
        admin2.classList.remove("active");
        admin1.classList.remove("active");
        sale.classList.remove("active");

        //active
        show_TQA.style.display = "flex";
        show_TQA.style.opacity = 0;
        setTimeout(() => {
            show_TQA.style.opacity = 1;
        }, 0); 

        // hidden
        show_admin1.style.display = "none";
        show_admin2.style.display = "none";
        show_admin3.style.display = "none";
        show_pl.style.display = "none";
        show_production.style.display = "none";
        show_sale.style.display = "none";
        show_auto.style.display = "none";


    }


//sale-auto
let sale = document.getElementById("btn-sale-auto");
let show_auto = document.getElementById("auto");
let show_sale = document.getElementById("sale");

    sale.addEventListener("click", btn_sale_auto);

    function btn_sale_auto(){
         //active
         sale.classList.add("active");
         TQA.classList.remove("active");
         production.classList.remove("active");
         pl.classList.remove("active");
         admin3.classList.remove("active");
         admin2.classList.remove("active");
         admin1.classList.remove("active");
 
 
         //active
        show_auto.style.display = "flex";
        show_auto.style.opacity = 0;
        show_sale.style.display = "flex";
        show_sale.style.opacity = 0;
        setTimeout(() => {
            show_auto.style.opacity = 1;
            show_sale.style.opacity = 1;
        }, 0); 

        // hidden
        show_admin1.style.display = "none";
        show_admin2.style.display = "none";
        show_admin3.style.display = "none";
        show_pl.style.display = "none";
        show_production.style.display = "none";
        show_TQA.style.display = "none";


    }



