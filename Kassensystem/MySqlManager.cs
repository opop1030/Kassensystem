using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data;
using System.Data.Odbc;

namespace Kassensystem
{
    public class MySqlManager : DbManager
    {

        private OdbcConnection connection;

        public MySqlManager(string connectionString)
        {
            conStr = connectionString;
            connection = null;
        }

        public DataSet ReadData(string querry)
        {
            Connect();
            DataSet ds = new DataSet();
            using(OdbcCommand command = connection.CreateCommand())
            {
                command.CommandText = querry;
                using (OdbcDataAdapter da = new OdbcDataAdapter(command))
                {
                    da.Fill(ds);
                }
            }
            Close();
            return ds;
        }

        public void ExecuteCommand(string querry)
        {
            Connect();
            using (OdbcCommand command = connection.CreateCommand())
            {
                command.CommandText = querry;
                command.ExecuteNonQuery();
            }
            Close();
        }

        public object ExecuteScalar(string querry)
        {
            Connect();
            object result = null;
            using(OdbcCommand command = connection.CreateCommand())
            {
                command.CommandText = querry;
                result = command.ExecuteScalar();
            }
            Close();
            return result;
        }

        public override void Connect()
        {
            try
            {
                connection = new OdbcConnection();
                connection.ConnectionString = conStr;
                connection.Open();
            }
            catch(Exception ex)
            {
                Close();
                throw ex;
            }
        }

        public override void Close()
        {
            if(connection != null)
            {
                connection.Close();
                connection = null;
            }
        }
    }
}
