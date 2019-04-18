using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Data.SqlClient;
using System.Data;
namespace CougarSearchWebsite
{
    public partial class _Default : Page
    {
        string connectionString = @"Data Source= (local)\""Data Source=(localdb)\MSSQLLocalDB;Initial Catalog=Cougar_Search;Integrated Security=True";

        protected void Page_Load(object sender, EventArgs e)
        {
            using (SqlConnection sqlCon = new SqlConnection(connectionString))
            {
                sqlCon.Open();
                SqlCommand command = new SqlCommand("spViewAllListings", sqlCon);
                command.CommandType = CommandType.StoredProcedure;
                SqlDataAdapter sqlDa = new SqlDataAdapter(command);
                DataTable dtbl = new DataTable();
                sqlDa.Fill(dtbl);
                gvDogs.DataSource = dtbl;
                gvDogs.DataBind();
            }
        }
        
    }
}