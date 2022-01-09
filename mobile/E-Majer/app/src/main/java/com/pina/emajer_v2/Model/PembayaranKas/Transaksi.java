package com.pina.emajer_v2.Model.PembayaranKas;

import java.util.ArrayList;
import java.util.List;

public class Transaksi {
    private String id_akun;
    private String id_kelas;
    private Integer total;
    private List<TransaksiDetail> transaksiDetail = new ArrayList<>();

    public String getId_akun() {
        return id_akun;
    }

    public void setId_akun(String id_akun) {
        this.id_akun = id_akun;
    }

    public String getId_kelas() {
        return id_kelas;
    }

    public Integer getTotal() {
        return total;
    }

    public void setTotal(Integer total) {
        this.total = total;
    }

    public void setId_kelas(String id_kelas) {
        this.id_kelas = id_kelas;
    }

    public List<TransaksiDetail> getTransaksiDetail() {
        return transaksiDetail;
    }

    public void setTransaksiDetail(List<TransaksiDetail> transaksiDetail) {
        this.transaksiDetail = transaksiDetail;
    }
}
