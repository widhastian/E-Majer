package com.kelompok.emajer.Model.RiwayatTransaksi;

public class RiwayatDetail {
    private int id_transaksi_detail;
    private int id_transaksi;
    private int id_minggu;
    private int nominal;
    private String keterangan;

    public int getId_transaksi_detail() {
        return id_transaksi_detail;
    }

    public void setId_transaksi_detail(int id_transaksi_detail) {
        this.id_transaksi_detail = id_transaksi_detail;
    }

    public int getId_transaksi() {
        return id_transaksi;
    }

    public void setId_transaksi(int id_transaksi) {
        this.id_transaksi = id_transaksi;
    }

    public int getId_minggu() {
        return id_minggu;
    }

    public void setId_minggu(int id_minggu) {
        this.id_minggu = id_minggu;
    }

    public int getNominal() {
        return nominal;
    }

    public void setNominal(int nominal) {
        this.nominal = nominal;
    }

    public String getKeterangan() {
        return keterangan;
    }

    public void setKeterangan(String keterangan) {
        this.keterangan = keterangan;
    }
}
