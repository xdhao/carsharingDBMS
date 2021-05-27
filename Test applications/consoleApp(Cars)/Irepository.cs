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
}