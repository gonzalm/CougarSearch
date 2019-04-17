using System;
using Xunit;

namespace XUnitTestProject1
{
    public class UnitTest1
    {
        [Fact]
        public void getUserEmailTest()
        {
            var testUser = new User("fdasfdsa", "fdasfdsa", "fdasfdsa", "fdasfdsa");
            Assert.Equal("fdasfdsa", testUser.getemail());
        }
        [Fact]
        public void getDogAgeTest()
        {
            var testDog = new Dog(1, "fido", "male", "fdasfdsa", "mixed", 4, DateTime.Now);
            Assert.Equal(4, testDog.getAge());
        }
    }
}

