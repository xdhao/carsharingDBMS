using System;
using System.Collections.Generic;
using Npgsql;

namespace DataBaseConnect
{
	public class PostgreCarsRepository : IRepository<Cars>
    {
        string connectionString = "Host=localhost;Username=postgres;Password=postgre;Database=CarsBD";
        public void Create(Cars cars)
        {
            using var con = new NpgsqlConnection(connectionString);
            con.Open();

            using var cmd = new NpgsqlCommand($"INSERT INTO cars (year, fuel_level, environmental_class) VALUES ({cars.Year}, {cars.Fuel}, {cars.Env_class});", con);

            cmd.ExecuteNonQuery();
        }
        public void Update(Cars cars)
        {
            using var con = new NpgsqlConnection(connectionString);
            con.Open();

            using var cmd = new NpgsqlCommand($"UPDATE cars SET year={cars.Year}, fuel_level={cars.Fuel}, environmental_class={cars.Env_class} WHERE id={cars.Id};", con);

            cmd.ExecuteNonQuery();
        }
        public void Delete(int id)
        {
            using var con = new NpgsqlConnection(connectionString);
            con.Open();

            using var cmd = new NpgsqlCommand($"DELETE FROM cars WHERE id={id};", con);

            cmd.ExecuteNonQuery();
        }
        public float GetRange(int id)
        {
            using var con = new NpgsqlConnection(connectionString);
            con.Open();

            using var cmd = new NpgsqlCommand($"SELECT cars.fuel_level, engines.fuel_consumption FROM cars, engines WHERE cars.id_engine = engines.id AND cars.id = { id};", con);

            var reader = cmd.ExecuteReader();
            reader.Read();

            return reader.GetFloat(0) * reader.GetInt32(1) * 100;
        }
        public IEnumerable<Cars> GetAutomat()
        {
            using var con = new NpgsqlConnection(connectionString);
            con.Open();

            using var cmd = new NpgsqlCommand($"SELECT cars.id, cars.year, cars.fuel_level, cars.environmental_class FROM cars JOIN transmissions ON cars.id_transmission = transmissions.id JOIN transmission_types ON transmissions.id_transmissions_type = transmission_types.id WHERE transmission_types.name = 'Автоматическая' OR transmission_types.name = 'Роботизированная';", con);
            
            var reader = cmd.ExecuteReader();
            var result = new List<Cars>();

            while (reader.Read())
            {
                result.Add(new Cars(reader.GetInt32(0), reader.GetInt32(1), reader.GetFloat(2), reader.GetInt32(3)));
            }

            return result;
        }
        public IEnumerable<Cars> GetHighFuelLevel()
        {
            using var con = new NpgsqlConnection(connectionString);
            con.Open();

            using var cmd = new NpgsqlCommand($"SELECT * FROM cars WHERE fuel_level > 5;", con);
            
            var reader = cmd.ExecuteReader();
            var result = new List<Cars>();

            while (reader.Read())
            {
                result.Add(new Cars(reader.GetInt32(0), reader.GetInt32(1), reader.GetFloat(2), reader.GetInt32(3)));
            }

            return result;
        }
        public IEnumerable<Cars> GetAll()
        {
            using var con = new NpgsqlConnection(connectionString);
            con.Open();

            using var cmd = new NpgsqlCommand("SELECT * FROM cars", con);

            var reader = cmd.ExecuteReader();
            var result = new List<Cars>();

            while (reader.Read())
            {
                result.Add(new Cars(reader.GetInt32(0), reader.GetInt32(1), reader.GetFloat(2), reader.GetInt32(3)));
            }

            return result;
        }
    }
}