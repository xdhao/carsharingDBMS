using System;
using System.Collections.Generic;
using System.Text;

namespace lab2
{
    public class Reviews
    {
        public int id { get; }
        public string text { get; set; }
        public float raiting { get; set; }
        public string vin { get; set; }
        public int id_clients { get; set; }

        public Reviews(int id, string text, float raiting, string vin, int id_clients)
        {
            this.id = id;
            this.text = text;
            this.raiting = raiting;
            this.vin = vin;
            this.id_clients = id_clients;
        }

        public override string ToString()
        {
            return $"{id}, {text}, {raiting}, {vin}, {id_clients}";
        }
    }
}
