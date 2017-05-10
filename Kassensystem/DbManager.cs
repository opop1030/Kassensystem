using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Kassensystem
{
    public abstract class DbManager
    {
        protected string conStr;

        public abstract void Connect();

        public abstract void Close();
    }
}
