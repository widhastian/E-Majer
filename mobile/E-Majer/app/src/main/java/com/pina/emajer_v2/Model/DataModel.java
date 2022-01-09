package com.pina.emajer_v2.Model;

public class DataModel {
    private String id_akun, nama, email, username, password, id_kelas;
    private int saldo;
    private String jumlah_saldo;

    public int getSaldo() {
        return saldo;
    }

    public String getJumlah_saldo() {
        return jumlah_saldo;
    }

    public void setJumlah_saldo(String jumlah_saldo) {
        this.jumlah_saldo = jumlah_saldo;
    }

    public void setSaldo(int saldo) {
        this.saldo = saldo;
    }

    public String getId() {
        return id_akun;
    }

    public void setId(String id_akun) {
        this.id_akun = id_akun;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getId_kelas() {
        return id_kelas;
    }

    public void setId_kelas(String id_kelas) {
        this.id_kelas = id_kelas;
    }
}
