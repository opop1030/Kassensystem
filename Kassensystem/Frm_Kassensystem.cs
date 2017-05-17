using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Kassensystem
{
    public partial class Frm_Kassensystem : Form
    {
        private MySqlManager db;

        public Frm_Kassensystem()
        {
            InitializeComponent();
            db = new MySqlManager("Driver={MySQL ODBC 5.2 UNICODE Driver};Server=tekassensystem.bplaced.net; user id=tekassensystem; pwd=gsokoeln;database=tekassensystem;");
            foreach(DataRow entry in db.ReadData("select * from test").Tables[0].Rows)
            {
                richTextBox1.Text += entry[0].ToString()+ " " +entry[1].ToString() + " " + entry[2].ToString() + "\n";
            }

            // tekassensystem
            // gsoköln
        }
    }
}
