using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Cougar_Searchv2.Models
{
    public class User
    {
        public int userName;
        private String password;
        public String email;
        public virtual ICollection<DogProfile> Listings{ get; set; }
    }
}