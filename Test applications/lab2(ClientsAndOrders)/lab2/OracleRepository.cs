using System;
using System.Collections.Generic;
using System.Data;
using System.Text;
using Oracle.ManagedDataAccess.Client;

namespace lab2
{
    public class OracleRepository : Irepository
    {
        string connectionString = "Data Source = (DESCRIPTION =" +
        " (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))" +
        " (CONNECT_DATA =" +
        "  (SERVER = DEDICATED)" +
        "  (SERVICE_NAME = orcle)" +
        " )" +
        ");User Id = SYS;password = 3004;DBA Privilege=SYSDBA;";
        public bool AddReviews(Reviews newreviews)
        {
            try
            {
                using var con = new OracleConnection(connectionString);
                con.Open();
                string query = "INSERT INTO reviews (text, raiting, vin, id_clients) VALUES (:text, :raiting, :vin, :id_clients)";
                OracleCommand command = new OracleCommand(query, con);
                OracleParameter[] parameters = new OracleParameter[] {
                    new OracleParameter("text", newreviews.text),
                    new OracleParameter("raiting", newreviews.raiting),
                    new OracleParameter("vin", newreviews.vin),
                    new OracleParameter("id_clients", newreviews.id_clients)
                    };
                command.Parameters.AddRange(parameters);
                command.ExecuteNonQuery();
                return true;
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                return false;
            }
        }
        public IEnumerable<Reviews> GetReviews()
        {
            var result = new List<Reviews>();
            using var con = new OracleConnection(connectionString);
            con.Open();
            string rev = "SELECT * FROM reviews";
            using var command = new OracleCommand(rev, con);
            using var readreRev = command.ExecuteReader();
            while (readreRev.Read())
            {
                result.Add(new Reviews(readreRev.GetInt32(0), readreRev.GetString(1), readreRev.GetFloat(2), readreRev.GetString(3), readreRev.GetInt32(4)));
            }
            return result;
        }
        public void DeleteReviews(Reviews newrivews)
        {
            using var con = new OracleConnection(connectionString);
            con.Open();
            string delete = "DELETE FROM reviews WHERE id = :id";
            using var command = new OracleCommand(delete, con);
            OracleParameter parameter = new OracleParameter("id", newrivews.id);
            command.Parameters.Add(parameter);
            command.ExecuteNonQuery();
        }
        public bool UpdateReviews(Reviews newreviews)
        {
            try
            {
                using var con = new OracleConnection(connectionString);
                con.Open();
                string update = "UPDATE reviews SET text = :text, raiting = :raiting, vin = :vin, id_clients = :id_clients WHERE id = :id";
                using var command = new OracleCommand(update, con);
                OracleParameter[] parameters = new OracleParameter[] {
                    new OracleParameter("text", newreviews.text),
                    new OracleParameter("raiting", newreviews.raiting),
                    new OracleParameter("vin", newreviews.vin),
                    new OracleParameter("id_clients", newreviews.id_clients),
                    new OracleParameter("id", newreviews.id)
            };
                command.Parameters.AddRange(parameters);
                command.ExecuteNonQuery();
                return true;

            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                return false;
            }
        }


        public string CalculationOfCost(Clients newClients)
        {
            using var con = new OracleConnection(connectionString);
            con.Open();
            string calcucat = "select value*calculationcost(raiting) from clients " +
            "join orders on clients.id = orders.id_clients " +
            "join tarrifs on tarrifs.id = orders.id_tarrifs " +
            "where clients.id = :id";
            using var command = new OracleCommand(calcucat, con);
            OracleParameter parameter = new OracleParameter("id", newClients.id);
            command.Parameters.Add(parameter);
            object count = command.ExecuteScalar();
            return count.ToString();
        }
    }
}

