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
            db = new MySqlManager("Driver={MySQL ODBC 5.2 UNICODE Driver};Server=localhost;Database=fahrrad;"
                + "User = root; Password = z6t5r4e3w2q1; Option = 3; ");
            foreach(DataRow entry in db.ReadData("select * from angestellte").Tables[0].Rows)
            {
                richTextBox1.Text += entry[2].ToString()+ " " +entry[3].ToString() + " " + entry[4].ToString() + "\n";
            }
        }
    }
}
