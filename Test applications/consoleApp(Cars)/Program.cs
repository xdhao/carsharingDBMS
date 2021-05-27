using System;
using System.Collections.Generic;
using Npgsql;

namespace DataBaseConnect
{
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
