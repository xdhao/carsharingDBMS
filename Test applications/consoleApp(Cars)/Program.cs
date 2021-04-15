using System;
using System.Collections.Generic;
using Npgsql;

namespace DataBaseConnect
{
    interface IRepository<T> where T : class
    {
        IEnumerable<T> GetAll();
        void Create(T item);
        void Update(T item);
        void Delete(int id);
        float GetRange(int id);
    }
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

            using var cmd = new NpgsqlCommand($"SELECT * FROM cars WHERE id_transmission in (SELECT id FROM transmissions WHERE id_transmission_type in (SELECT id FROM transmission_types WHERE name = "Автоматическая" OR name = "Роботизированная"));", con);
            
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
    public class Cars
    {
        public int Id { get; set; }
        public int Year { get; set; }
        public int Env_class { get; set; }
        public float Fuel { get; set; }
        public Cars()
        {
            this.Year = 2000;
            this.Env_class = 1;
            this.Fuel = 1;
        }
        public Cars(int Year, float Fuel, int Env_class)
        {
            this.Year = Year;
            this.Env_class = Env_class;
            this.Fuel = Fuel;
        }
        public Cars(int Id, int Year, float Fuel, int Env_class)
        {
            this.Id = Id;
            this.Year = Year;
            this.Env_class = Env_class;
            this.Fuel = Fuel;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            IRepository<Cars> myRep = new PostgreCarsRepository();

            char cmd;
            do
            {
                Console.WriteLine("s - Вывод списка\na - Добавление новой строки\nu - Редактирование строки\nd - Удаление строки\nr - Ввод конкретного запроса\nx - Выход из программы");
                cmd = Console.ReadKey().KeyChar;
                switch (cmd)
                {
                    case 's':
                        ShowCars(myRep);
                        break;
                    case 'a':
                        AddCar(myRep);
                        break;
                    case 'u':
                        UpdateCar(myRep);
                        break;
                    case 'd':
                        DeleteCar(myRep);
                        break;
                    case 'r':
                        RangeRequest(myRep);
                        break;
                    case 'c':
                        AutomatRequest(myRep);
                        break;
                    case 'h':
                        HighFuelLevelRequest(myRep);
                        break;
                    case 'x':
                        Console.WriteLine("Выход из программы...");
                        break;
                }

            } while (cmd != 'x');
        }
        static void ShowCars(IRepository<Cars> myRep)
        {
            var carsList = new List<Cars>(myRep.GetAll());

            Console.WriteLine($"id\tyear\tfuel_level\tevironmental_class");
            for (int i = 0; i < carsList.Count; i++)
                Console.WriteLine($"{carsList[i].Id}\t{carsList[i].Year}\t{carsList[i].Fuel}\t\t{carsList[i].Env_class}");
        }
        static void AddCar(IRepository<Cars> myRep)
        {
            int year, env_class;
            float fuel;

            Console.WriteLine("Введите год выпуска автомобиля");
            year = Convert.ToInt32(Console.ReadLine());
            Console.WriteLine("Введите уровень топлива");
            fuel = float.Parse(Console.ReadLine());
            Console.WriteLine("Введите экологический класс");
            env_class = Convert.ToInt32(Console.ReadLine());

            Cars car = new Cars(year, fuel, env_class);

            myRep.Create(car);
        }
        static void UpdateCar(IRepository<Cars> myRep)
        {
            int year, env_class, id;
            float fuel;

            Console.WriteLine("Введите ID автомобиля");
            id = Convert.ToInt32(Console.ReadLine());
            Console.WriteLine("Введите новый год выпуска автомобиля");
            year = Convert.ToInt32(Console.ReadLine());
            Console.WriteLine("Введите новый уровень топлива");
            fuel = float.Parse(Console.ReadLine());
            Console.WriteLine("Введите новый экологический класс");
            env_class = Convert.ToInt32(Console.ReadLine());

            Cars car = new Cars(id, year, fuel, env_class);

            myRep.Update(car);
        }
        static void DeleteCar(IRepository<Cars> myRep)
        {
            int id;

            Console.WriteLine("Введите ID автомобиля");
            id = Convert.ToInt32(Console.ReadLine());

            myRep.Delete(id);
        }
        static void RangeRequest(IRepository<Cars> myRep)
        {
            int id;
        
            Console.WriteLine("Введите ID автомобиля");
            id = Convert.ToInt32(Console.ReadLine());

            float range = myRep.GetRange(id);

            Console.WriteLine($"Осталось километров: {range}");
        }
        static void AutomatRequest(IRepository<Cars> myRep)
        {
            var carsList = new List<Cars>(myRep.GetAutomat());

            Console.WriteLine($"id\tyear\tfuel_level\tevironmental_class");
            for (int i = 0; i < carsList.Count; i++)
                Console.WriteLine($"{carsList[i].Id}\t{carsList[i].Year}\t{carsList[i].Fuel}\t\t{carsList[i].Env_class}");
        }
        static void HighFuelLevelRequest(IRepository<Cars> myRep)
        {
            var carsList = new List<Cars>(myRep.GetHighFuelLevel());

            Console.WriteLine($"id\tyear\tfuel_level\tevironmental_class");
            for (int i = 0; i < carsList.Count; i++)
                Console.WriteLine($"{carsList[i].Id}\t{carsList[i].Year}\t{carsList[i].Fuel}\t\t{carsList[i].Env_class}");
        }
    }
}
