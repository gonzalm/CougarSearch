using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(CougarSearchWebsite.Startup))]
namespace CougarSearchWebsite
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
