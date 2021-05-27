using System;
using System.Collections.Generic;
using Npgsql;

namespace DataBaseConnect
{
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
}