using System;
using System.Collections.Generic;
using System.Text;

namespace lab2
{
    public class Clients
    {
        public int id { get; }
        public string name { get; set; }
        public string surname { get; set; }
        public string patronymic { get; set; }
        public string login { get; set; }
        public string password { get; set; }
        public string passport_data { get; set; }
        public string number_driver_licence { get; set; }
        public float raiting { get; set; }
        public int id_offices { get; set; }

        public Clients(int id, string name, string surname, string patronymic, string login, string password, string passport_data, string number_driver_licence, float raiting, int id_offices)
        {
            this.id = id;
            this.name = name;
            this.surname = surname;
            this.patronymic = patronymic;
            this.login = login;
            this.password = password;
            this.passport_data = passport_data;
            this.number_driver_licence = number_driver_licence;
            this.raiting = raiting;
            this.id_offices = id_offices;
        }
    }

}
