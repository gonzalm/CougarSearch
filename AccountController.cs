using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Login_MVC_.Models;
using System.Data.SqlClient;
namespace Login_MVC_.Controllers
{
    public class AccountController : Controller
    {
        SqlConnection con = new SqlConnection();
        SqlCommand com = new SqlCommand();
        SqlDataReader dr;
        // GET: Account
        [HttpGet]
        public ActionResult Login()
        {
            return View();
        }
        void connectionString()
        {
            con.ConnectionString = "data source = (localdb)/MSSQLLocalDB; database = Cougar_Search; integrated sercruity = SSPI;";
        }
        [HttpPost]
        public ActionResult Verfiy(Account ac)
        {
            connectionString();
            con.Open();
            com.Connection = con;
            com.CommandText = "select * from tbl_Users where userName = '"+ac.userName+"' and password = '"+ac.Password+"' ";
            dr = com.ExecuteReader();
            if(dr.Read())
            {
                con.Close();
                return View("Create");
            }
            else{
                con.Close();
                return View("Error");
            }


            

        }
    }
}