package com.kelompok.emajer.Model.RiwayatTransaksi;

import java.util.List;

public class RiwayatAll {

    private int id_transaksi;
    private String tanggal_bayar;
    private Integer total;
    private String status;
    private List<RiwayatDetail> riwayatDetail;

    public int getId_transaksi() {
        return id_transaksi;
    }

    public void setId_transaksi(int id_transaksi) {
        this.id_transaksi = id_transaksi;
    }

    public String getTanggal_bayar() {
        return tanggal_bayar;
    }

    public void setTanggal_bayar(String tanggal_transaksi) {
        this.tanggal_bayar = tanggal_transaksi;
    }

    public Integer getTotal() {
        return total;
    }

    public void setTotal(Integer total) {
        this.total = total;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public List<RiwayatDetail> getRiwayatDetail() {
        return riwayatDetail;
    }

    public void setRiwayatDetail(List<RiwayatDetail> riwayatDetail) {
        this.riwayatDetail = riwayatDetail;
    }
}
