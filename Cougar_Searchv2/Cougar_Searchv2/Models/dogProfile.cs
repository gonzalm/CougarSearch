using System;

namespace Cougar_Searchv2.Models
{
    public class DogProfile
    {
        public int ListingID;
        public string dogName;
        public string gender;
        public string dogDesc;
        public string breed;
        public int age;
        public string userName;
        public DateTime DatePosted { get; set; }
    }
}