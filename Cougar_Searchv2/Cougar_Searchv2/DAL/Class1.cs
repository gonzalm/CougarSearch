using Cougar_Searchv2.Models;
using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;
namespace Cougar_Searchv2.DAL
{
    public class SiteContext : DbContext
    {
        public SiteContext() : base("DefaultConnection")
        { }

        public DBSet<User> User { get; set; }
        public DBSet<DogProfile> DogProfile { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
        }
    }
}